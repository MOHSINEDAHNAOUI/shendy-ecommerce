<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Administrators cannot participate in the consumer shopping flow.');
        }

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        
        $quantity = (int) $request->input('quantity', 1);
        
        // Initial Stock Check
        if ($product->stock < $quantity) {
             return redirect()->back()->with('error', 'We do not have enough items in stock.');
        }

        if (isset($cart[$id])) {
            if (($cart[$id]['quantity'] + $quantity) > $product->stock) {
                return redirect()->back()->with('error', 'We do not have enough items in stock.');
            }
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $product = Product::find($id);
            
            if (!$product || $request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'We do not have enough items in stock.');
            }
            
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}