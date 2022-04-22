<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'parent_id'];

    public function rules()
    {
        return [
            'title'     => 'required',
            'slug'      => 'required|alpha_dash|unique:categories,slug,' . $this->id,
            'parent_id' => 'not_in:' . $this->id . '|nullable'
        ];
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) => $query->where('title', 'like', '%'.$search.'%')
        );
        $query->when($filters['product'] ?? false,
            fn($query, $product) => $query->whereHas('products', fn($query) => (is_array($product) ? $query->whereIn('id', $product) : $query->where('id', $product) )
            )
        );

    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Product');
    }

    // One level child
    public function child()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    // Recursive children
    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->with('children');
    }

    // One level parent
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    // Recursive parents
    public function parents()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->with('parent');
    }

    public function allChildren (): Collection
    {
        $children = new Collection();

        foreach ($this->children as $child) {
                $children->push($child);
            $children = $children->merge($child->allChildren());
        }

        return $children;
    }
}
