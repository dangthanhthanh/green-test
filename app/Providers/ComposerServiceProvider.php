<?php

namespace App\Providers;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $arrayView = [
        //     'clients.pages.checkout',
        //     'clients.pages.cart',
        //     'clients.pages.home'
        // ];
        // View::composer($arrayView, function ($view) {
        //     $view->with('test_laravel', 'Le Van C');
        // });

        $arrayProductCategorryView = [
            'clients.pages.checkout',
            'clients.pages.cart',
            'clients.pages.home',
            'clients.pages.shop',
        ];
        View::composer($arrayProductCategorryView, function ($view) {
            $productCategories = ProductCategory::orderBy('name', 'desc')->get()->filter(function ($productCategory) {
                return $productCategory->products->count() > 0;
            })->slice(0, 10);
            $view->with('productCategories', $productCategories);
        });
    }
}
