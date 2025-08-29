<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('price');

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart[] = [
            'report' => $request->report,
            'price'  => (float) $request->price,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Report added to cart!');
    }

    public function remove($index)
    {
        $cart = session()->get('cart', []);
        unset($cart[$index]);
        session()->put('cart', $cart);

        return back()->with('success', 'Report removed.');
    }
}
