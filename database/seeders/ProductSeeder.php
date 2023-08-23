<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i = 1; $i <= 20; $i++) {
           Category::query()->create([
               'id' => $i,
               'created_by' => 1,
               'name' => $faker->company,
               'code' => $faker->slug,
           ]);
        }


        for($i = 0; $i < 100; $i++) {
            Product::query()->create([
                'created_by' => 1,
                'slug' => $faker->slug,
                'active' => 1,
                'title' => $faker->company,
                'description' => $faker->paragraph(),
                'price' => $faker->numberBetween(10, 2000),
            ]);
        }

        $products = Product::all();
        foreach ($products as $product) {
            ProductCategory::query()->insert([
                'product_id' => $product->id,
                'category_id' => $faker->numberBetween(1, 20),
            ]);
        }

//        ProductResource::destroy(ProductResource::all()->pluck('id'));
    }
}
