<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TestSendMailController extends Controller
{
    public function sendMail()
    {
        $name = Auth::user()->name;
        //send mail
        //Cach 1
        $arrayMail = ['nguyenlyhuuphuc@gmail.com', 'maimanhvu456@gmail.com'];
        Mail::to($arrayMail)->send(new TestMail($name));

        //Cach 2
        foreach ($arrayMail as $email) {
            Mail::to($email)->send(new TestMail($name));
        }
    }
}
