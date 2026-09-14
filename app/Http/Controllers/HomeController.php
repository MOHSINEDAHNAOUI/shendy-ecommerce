<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Apply Search Keyword
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        // Apply Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Apply Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        // If AJAX request, return only the product grid partial
        if ($request->ajax()) {
            return view('partials.product-grid', compact('products'))->render();
        }

        return view('home', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product', compact('product'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    // Manual Password Reset Logic
    public function showManualResetForm()
    {
        return view('auth.passwords.manual_request');
    }

    public function verifyUserForReset(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $user = User::where('name', $request->name)
                    ->where('email', $request->email)
                    ->first();

        if ($user) {
            session(['reset_email' => $user->email]);
            return redirect()->route('password.manual.reset');
        }

        return back()->withErrors(['email' => 'No account found with this name and email combination.']);
    }

    public function showNewPasswordForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.manual.request');
        }
        return view('auth.passwords.manual_reset');
    }

    public function updatePasswordManual(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.manual.request');
        }

        $user = User::where('email', $email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            session()->forget('reset_email');
            return redirect()->route('login')->with('success', 'Password updated successfully! You can now login.');
        }

        return redirect()->route('password.manual.request')->withErrors(['email' => 'An error occurred. Please try again.']);
    }
}