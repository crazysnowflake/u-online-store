<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $category = is_array(request('category')) ? request('category') : [request('category')];
        $product = is_array(request('product')) ? request('product') : [request('product')];
        return view('welcome',[
            'one' => Category::filter(request(['product']))->pluck('title'),
            'two' => Product::onCategory($category, true)->pluck('name'),
            'three' => Product::whereHas('categories', function($query) use ($product)
            {
                $query->whereIn('id', $product);
            })->whereNotIn('id', $product)->pluck('name'),
            'four' => Category::find($category[0])
        ]);
    }
}
