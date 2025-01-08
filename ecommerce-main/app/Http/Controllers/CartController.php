<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('home.carts.list', compact('carts'));
        } else {
            return view('home.carts.list');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        $cart = Cart::where('product_id', $request->productId)
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($cart) {
            $cart->update([
                'qty' => $cart->qty + 1,
                'amount' => $cart->qty * $product->price,
            ]);
        } else {
            // Cart::create([
            //     'user_id' => Auth::user()->id,
            //     'product_id' => $request->productId,
            //     'qty' => 1,
            //     'amount' => $product->price,
            // ]);
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->productId;
            $cart->qty = 1;
            $cart->amount = $product->price;
            $cart->save();

        }

        return redirect()->back()->with('success', 'This product added to your cart');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($carts as $item) {
                $formData = $request->input("items.$item->id");
                $item->qty = $formData['qty'];
                $item->amount = $formData['qty'] * $formData['price'];
                $item->save();
            }

            Cart::where('qty',0)->delete();
            return redirect()->back()->with('success', 'Cart updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
