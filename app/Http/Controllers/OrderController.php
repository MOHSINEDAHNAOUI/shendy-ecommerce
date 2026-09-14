<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Administrators cannot participate in the checkout flow.');
        }

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('checkout', compact('cart', 'total'));
    }

    public function place(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20'
        ]);
        
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }
        
        $total = 0;
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if (!$product || $product->stock < $item['quantity']) {
                $name = $item['name'] ?? 'Product';
                return redirect()->back()->with('error', "Sorry, {$name} is no longer available in the requested quantity. Please update your cart.");
            }
            $total += $item['price'] * $item['quantity'];
        }
        
        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'phone' => $request->phone
        ]);
        
        // Create order items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
            
            // Update product stock
            $product = Product::find($id);
            $product->stock -= $item['quantity'];
            $product->save();
        }
        
        // Clear cart
        session()->forget('cart');
        
        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->where('user_id', auth()->id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function downloadPdf($id)
    {
        $order = Order::with('items.product')->where('user_id', auth()->id())->findOrFail($id);
        
        // Generate QR Code using chillerlan/php-qrcode
        // We link to the order detail page.
        $url = route('orders.show', $order->id);
        
        // render() returns a base64 string for SVG by default in newer versions, or raw checks.
        // Actually, default render is base64 depending on options.
        // Let's use SVG.
        $options = new \chillerlan\QRCode\QROptions([
            'outputType' => \chillerlan\QRCode\QRCode::OUTPUT_MARKUP_SVG,
            'imageBase64' => true,
        ]);
        $qrCode = (new \chillerlan\QRCode\QRCode($options))->render($url);
        
        // Create a narrative
        $itemCount = $order->items->sum('quantity');
        $date = $order->created_at->format('F d, Y');
        $narrative = "This order (#{$order->id}) was placed on {$date}. It contains {$itemCount} items including " . 
                     $order->items->take(3)->map(function($item) {
                         return $item->product->name ?? 'Unknown Item'; 
                     })->implode(', ') . 
                     ($order->items->count() > 3 ? " and others." : ".") . 
                     " The total amount is $" . number_format($order->total, 2) . ".";

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('orders.pdf', compact('order', 'qrCode', 'narrative'));
        return $pdf->download('order-'.$order->id.'.pdf');
    }
}