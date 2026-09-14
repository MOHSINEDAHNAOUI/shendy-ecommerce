<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $productData = $request->only(['name', 'description', 'price', 'stock', 'category_id']);

        if ($request->hasFile('image')) {
            $imageName = time().'_main.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $productData['image'] = 'images/products/'.$imageName;
        }

        $product = Product::create($productData);

        // Handle additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = time().'_'.$key.'.'.$image->extension();
                $image->move(public_path('images/products'), $imageName);
                $product->images()->create([
                    'image_path' => 'images/products/'.$imageName
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);
        $productData = $request->only(['name', 'description', 'price', 'stock', 'category_id']);

        if ($request->hasFile('image')) {
            // Optional: delete old main image if needed
            $imageName = time().'_main.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $productData['image'] = 'images/products/'.$imageName;
        }

        $product->update($productData);

        // Handle additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = time().'_'.rand(100, 999).'.'.$image->extension();
                $image->move(public_path('images/products'), $imageName);
                $product->images()->create([
                    'image_path' => 'images/products/'.$imageName
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroyImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);
        $productId = $image->product_id;
        
        // Delete physical file
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }
        
        $image->delete();
        
        return redirect()->back()->with('success', 'Image removed successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}