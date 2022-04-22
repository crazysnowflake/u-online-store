<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ProductDropdown extends Component
{
    public Collection $products;
    public ?Collection $currentProduct = null;
    public function __construct(Collection|string $currentProduct = null)
    {
        $this->products = Product::all();
        $request = is_array(request('product')) ? request('product') : [request('product')];

        $this->currentProduct = match (true){
            $currentProduct && ($currentProduct instanceof Collection) => $currentProduct,
            $currentProduct && !($currentProduct instanceof Collection) => Product::whereIn('id', [$currentProduct])->pluck('id'),
            default => Product::whereIn('id', $request)->pluck('id')
        };
    }

    public function render()
    {
        return view('components.product.dropdown');
    }
}
