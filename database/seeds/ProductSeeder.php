<?php

use App\CategoryProduct;
use App\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        factory(App\Product::class, 30)->create()->each(function ($product) use ($categories) {
            CategoryProduct::create([
                'category_id' => $categories->random()->id,
                'product_id' => $product->id
            ]);
        });
    }
}
