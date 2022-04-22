<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $c = Category::all();
        $exist = $c->first();
        $name = $this->faker->word();
        return [
            'title' => ucfirst($name),
            'slug' => Str::slug($name , "-"),
            'parent_id' =>  $exist ? $c->random()->id : null
        ];
    }
}
