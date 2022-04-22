<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['email' => 'elenkadark@local.test', 'name' => 'Olena Admin']);
        Product::factory(20)->create();
        Category::factory(3)->create();
        Category::factory(5)->create();
        Category::factory(5)->create();

        DB::table('category_product')->insertOrIgnore(
            collect(range(0, 30))->map(function(){
                return [
                    'product_id' => Product::all()->random()->id,
                    'category_id' => Category::all()->random()->id,
                ];
            })->toArray()
        );
    }
}
