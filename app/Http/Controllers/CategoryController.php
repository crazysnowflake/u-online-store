<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::latest()->filter(
                request(['search'])
            )->whereNull('parent_id')->with('children')->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store()
    {
        Category::create(request()->validate((new Category)->rules()));
        return redirect('/dashboard/categories' )->with('success', 'Category Created!');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', ['category' => $category]);
    }

    public function update(Category $category)
    {
        $category->update(request()->validate($category->rules()));
        return redirect('/dashboard/categories' )->with('success', 'Category Updated!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category Deleted!');
    }
}
