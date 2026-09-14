<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::where('is_admin', false)->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalUsers', 'pendingOrders'));
    }

    public function orders()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->back()->with('success', 'Order status updated!');
    }
}