<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CategoryDropdown extends Component
{
    public Collection $categories;
    public ?Collection $currentCategory = null;
    public function __construct(Collection|string $currentCategory = null)
    {
        $this->categories = Category::where('parent_id', null)->with('children')->get();
        $request = is_array(request('category')) ? request('category') : [request('category')];

        $this->currentCategory = match (true){
            $currentCategory && ($currentCategory instanceof Collection) => $currentCategory,
            $currentCategory && !($currentCategory instanceof Collection) => Category::whereIn('id', [$currentCategory])->pluck('id'),
            default => Category::whereIn('id', $request)->pluck('id')
        };
    }

    public function render()
    {
        return view('components.category.dropdown');
    }
}
