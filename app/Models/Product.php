<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'name', 'slug', 'sku', 'description'];

    public function rules()
    {
        return [
            'name'  => 'required',
            'slug'  => 'required|alpha_dash|unique:products,slug,'.$this->id,
            'sku'   => '',
            'description'   => '',
            'price' => 'required|numeric|between:0,999',
        ];
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where(fn($query) => $query->where('name', 'like', '%'.$search.'%')
                                                                     ->orWhere('sku', 'like', '%'.$search.'%')
            )
        );

        $query->when($filters['category'] ?? false,
            fn($query, $category) => $query->whereHas('categories', fn($query) => (is_array($category) ? $query->whereIn('id', $category) : $query->where('id', $category))
            )
        );
    }
    public function scopeOnCategory($query, array $category_id, $subCategory = false)
    {
        $children = $categories = Category::whereIn('id', $category_id)->get();
        if( $subCategory ){
            foreach ($categories as $child) {
                $children = $children->merge($child->allChildren());
            }
        }
        $query->whereHas('categories', fn($query) => $query->whereIn('id', $children->pluck('id')));
    }



    public function categories(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
