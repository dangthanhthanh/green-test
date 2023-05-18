<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart') ?? [];

        // $productCategories = ProductCategory::orderBy('name', 'desc')
        //     ->get()
        //     ->filter(function ($productCategory) {
        //         return $productCategory->products->count() > 0;
        //     })->slice(0, 10);

        return view('clients.pages.cart', compact('cart'));
    }

    public function addProductToCart($id)
    {
        $product = Product::find($id);

        $cart = session()->get('cart') ?? [];

        //Add product
        $cart[$id]['qty'] = ($cart[$id]['qty'] ?? 0) + 1;
        $cart[$id]['price'] = $product->price;
        $cart[$id]['name'] = $product->name;
        $cart[$id]['image'] = $product->image_url;

        session()->put('cart', $cart);
        $totalCart = $this->totalCart($cart);
        session()->put('total_cart', $totalCart);

        return response()->json(['id' => $id, 'total_cart' => $totalCart]);
    }

    public function deleteProductInCart($id)
    {
        $cart = session()->get('cart') ?? [];
        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            $totalCart = $this->totalCart($cart);
            session()->put('total_cart', $totalCart);
        }
        return response()->json(['id' => $id, 'total_cart' => $totalCart]);
    }

    public function totalCart(array $cart): string
    {
        $total = 0;
        if (count($cart) > 0) {
            foreach ($cart as $item) {
                $total += $item['price'] * $item['qty'];
            }
        }
        return number_format($total, 2);
    }

    public function deleteAllItems()
    {
        session()->put('cart', []);
        session()->put('total_cart', number_format(0, 2));
        return redirect()->route('cart.cart');
    }

    public function updateProductInCart($id, $qty)
    {
        $cart = session()->get('cart') ?? [];
        if (array_key_exists($id, $cart)) {
            if ($qty == 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['qty'] = $qty;
            }

            session()->put('cart', $cart);
            $totalCart = $this->totalCart($cart);
            session()->put('total_cart', $totalCart);
        }

        return response()->json(['id' => $id]);
    }
}
