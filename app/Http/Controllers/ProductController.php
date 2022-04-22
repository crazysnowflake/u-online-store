<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.products.index', [
            'products' => Product::latest()->filter(
                request(['search', 'category'])
            )->with('categories')->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('dashboard.products.create');
    }

    public function store()
    {
        $product = Product::create(request()->validate((new Product)->rules()));
        $product->categories()->attach(request('category'));
        return redirect('/dashboard/products' )->with('success', 'Product Created!');
    }

    public function edit(Product $product)
    {
        return view('dashboard.products.edit', ['product' => $product]);
    }

    public function update(Product $product)
    {
        $product->update(request()->validate($product->rules()));
        $product->categories()->detach();
        $product->categories()->attach(request('category'));
        return redirect('/dashboard/products' )->with('success', 'Product Updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product Deleted!');
    }

}
