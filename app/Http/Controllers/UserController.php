<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $model;

    public function __construct(User $userModel)
    {
        $this->model = $userModel;
    }

    public function getAllUser()
    {
        $users = [
            ['id' => 1, 'name' => 'xoai', 'description' => '<p data-placeholder="Type or paste your content here!"><i><strong><u>Tieu de</u></strong></i></p>'],
            ['id' => 2, 'name' => 'quyt', 'description' => ''],
            ['id' => 3, 'name' => 'oi', 'description' => ''],
            ['id' => 4, 'name' => 'coc', 'description' => ''],
            ['id' => 6, 'name' => 'tao', 'description' => '']
        ];


        $userLevel = 3;

        return view('admin.pages.user.list', compact('users', 'userLevel'));
    }

    public function store(UserCreateRequest $request)
    {
        $request = $request->except('_token', 'password_confirmation');
        $request[] = date('Y-m-d H:i:s');
        $request[] = date('Y-m-d H:i:s');
        $request['password'] = Hash::make($request['password']);

        DB::insert(
            'INSERT INTO  user ( name, phone, email , password, status, is_admin, created_at, updated_at)
        VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)',
            array_values($request)
        );

        //Flash data in Laravel
        return redirect()->route('admin.user')
            ->with('message', 'Thanh Cong !!!');
    }

    public function index()
    {
        //SQL Raw
        // $users = DB::select('select id,name from user');
        // dd($users[0]);


        //QueryBuilder
        // $users = DB::table('user')->get();

        // $users = DB::table('user')->select('id', 'name')->get();

        // $user = DB::table('user')->first();
        // DB::enableQueryLog();
        // $users = DB::table('user')->whereBetween('id', [10, 15])->get();
        // $users = DB::table('user')->whereIn('id', [1, 6])->get();
        // $users = DB::table('user')->whereNull('updated_at')->get();
        // $users = DB::table('user')->whereTime('created_at', '12:43:59')->get();

        // DB::table('users')
        //     ->updateOrInsert(
        //         ['email' => 'john@example.com', 'name' => 'John'],
        //         ['votes' => '2']
        //     );

        // $users = DB::table('user')->whereColumn('updated_at', '>', 'created_at')->get();
        // $users = DB::table('user')
        //     ->where('id', '>', 5)
        //     ->orWhere('status', 1)
        //     ->get();
        // $users = DB::table('user')
        //     ->where([
        //         ['id', '>', 5],
        //         ['status', 1]
        //     ])
        //     ->get();
        // dd(DB::getQueryLog());

        // dd($users);

        $users = $this->model->getAll();
        return view('admin.pages.user.list', ['users' => $users]);
    }

    public function show($id)
    {
        // DB::enableQueryLog();
        $user = DB::select('select * from user where id = :id', ['id' => $id]);
        // dd(DB::getQueryLog());

        // $user = DB::select('select * from user where id = ?', [$id]);
        return view('admin.pages.user.detail')->with('user', $user[0]);
    }

    public function update(UserUpdateRequest $request)
    {
        // $data['phone'] = $request->get('phone');
        // $data['email'] = $request->get('email');
        // $data['name'] = $request->get('name');

        $data = $request->except('_token', 'password', 'password_confirmation');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $bool = DB::update('Update user set name = :name, phone = :phone, email = :email, status = :status,updated_at = :updated_at
        where id = :id', $data);

        $message = 'That bai';
        if ($bool) {
            $message = 'Thanh Cong';
        }

        return redirect()->route('admin.user')->with('message', $message);
    }

    public function destroy($id)
    {
        $bool = DB::delete('Delete from user where id = ?', [$id]);

        $message = 'That bai';
        if ($bool) {
            $message = 'Thanh Cong';
        }

        return redirect()->route('admin.user')->with('message', $message);
    }

    public function giaodiendangnhap()
    {
        return view('clients.pages.dangnhap');
    }

    public function dangnhap(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Ten dang nhap hoac mat khau khong ton tai !',
        ])->onlyInput('email');
    }

    public function dangxuat()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
