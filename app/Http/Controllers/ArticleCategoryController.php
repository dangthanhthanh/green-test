<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleCategories = ArticleCategory::withTrashed()->get();
        return view('admin.pages.article_category.list', compact('articleCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.article_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|min:3']);

        $article = new ArticleCategory();
        $article->name = $request->name;
        $article->save();

        // $check = ArticleCategory::insert(['name' => $request->name, 'created_at' => now(), 'updated_at' => now()]);
        // $message = $check ? 'success' : 'failed';

        //flash data session
        // return redirect()->route('article-category.index')->with('message', $message);
        return redirect()->route('article-category.index');
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
    public function edit(ArticleCategory $articleCategory)
    {
        // $articleCategory = ArticleCategory::find($id);
        return view('admin.pages.article_category.detail')->with('articleCategory', $articleCategory);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->delete();
        return redirect()->route('article-category.index');
    }

    public function restore($id)
    {
        ArticleCategory::withTrashed()->find($id)->restore();
        return redirect()->route('article-category.index');
    }
}
