<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // $productCategories = ProductCategory::orderBy('name', 'desc')->get()->filter(function ($productCategory) {
        //     return $productCategory->products->count() > 0;
        // })->slice(0, 10);

        // $productCategories = ProductCategory::limit(10)->get();

        $products = DB::table('product')
            ->join('product_category', 'product.product_category_id', '=', 'product_category.id')
            ->select('product.*', 'product_category.name as category_name')
            ->where('product_category.deleted_at', NULL)
            ->orderBy('product.id', 'desc')
            ->limit(8)
            ->get();

        $arrayProductCategory = $products->pluck('category_name')->unique();

        $latestProducts = Product::orderBy('id', 'desc')->limit(3)->get();
        $articles = Article::orderBy('id', 'desc')->limit(3)->get();

        return view('clients.pages.home', compact('products', 'arrayProductCategory', 'latestProducts', 'articles'));
    }
}
