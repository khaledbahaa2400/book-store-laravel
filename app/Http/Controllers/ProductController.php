<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        if (Route::is('user.products.index')) :
            return view('user.products', ['products' => $products]);
        else :
            return view('admin.products', ['products' => $products]);
        endif;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|min:0',
            'image' => 'required|image'
        ]);

        $path = request('image')->store('products', 'public');
        $validated['image'] = $path;

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Added Successfully');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('admin.products', ['products' => Product::all(), 'editingProduct' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|min:0',
            'image' => 'required|image'
        ]);

        $path = request('image')->store('products', 'public');
        $validated['image'] = $path;

        Storage::disk('public')->delete($product->image ?? '');
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        Storage::disk('public')->delete($product->image ?? '');
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Deleted Successfully');
    }

    public function search()
    {
        $products = [];
        $keyword = request('keyword');
        if ($keyword)
            $products = Product::where("name", "like", "%{$keyword}%")->get();

        return view('user.search', ['products' => $products]);
    }
}
