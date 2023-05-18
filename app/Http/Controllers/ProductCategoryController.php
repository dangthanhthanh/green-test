<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query builder
        // $productCategories = DB::table('product_category')->get();
        // $productCategories = ProductCategory::all();
        // $productCategories = ProductCategory::where('name', 'like', '%a%')->get();
        $productCategories = ProductCategory::orderByDesc('id')->get();

        // dd($productCategories);
        return view('admin.pages.product_category.list', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:255']);

        // $request->all();
        $productCategory = ProductCategory::create(['name' => $request->name]);

        // $productCategory = ProductCategory::insert(['name' => $request->name]);

        // $productCategory = new ProductCategory;
        // $productCategory->name = $request->name;
        // $productCategory->save();

        return redirect()->route('product-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCategory = ProductCategory::find($id);
        return view('admin.pages.product_category.detail', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //B1 Validate Requset
        $request->validate(['name' => 'required|max:255']);

        //TIm record dang dc update
        $productCategory = ProductCategory::find($id);
        $productCategory->update(['name' => $request->name]);

        return redirect()->route('product-category.index')->with('message', 'Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productCategory = ProductCategory::find($id);
        // $productCategory->delete();
        $productCategory->forceDelete();

        return redirect()->route('product-category.index');
    }
}
