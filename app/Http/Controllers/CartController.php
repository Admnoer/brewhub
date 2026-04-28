<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
    {
        // return "MASUK ADD";
        $user = auth()->user();

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        $product = Product::findOrFail($id);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $id)
            ->first();

        if ($item) {
            $item->qty += 1;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $id,
                'qty' => 1,
                'price' => $product->price
            ]);
        }
        // dd("MASUK DB");
        $cart->total = CartItem::where('cart_id', $cart->id)
            ->sum(\DB::raw('qty * price'));

        $cart->save();

        return back();
    }
    public function index()
{
    $cart = \App\Models\Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->where('status', 'pending')
        ->first();

    return \Inertia\Inertia::render('Cart/Index', [
        'cart' => $cart
    ]);
}
public function checkout()
{
    $cart = \App\Models\Cart::where('user_id', auth()->id())
        ->where('status', 'pending')
        ->first();

    if ($cart) {
        $cart->status = 'selesai';
        $cart->save();
    }

    return redirect('/history');
}public function history()
{
    $carts = \App\Models\Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->where('status', 'selesai')
        ->get();

    return \Inertia\Inertia::render('History/Index', [
        'carts' => $carts
    ]);
}public function show($id)
{
    $product = Product::findOrFail($id);

    return \Inertia\Inertia::render('Products/Show', [
        'product' => $product
    ]);
}
}
