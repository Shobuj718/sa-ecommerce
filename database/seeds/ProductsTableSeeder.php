<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 20)->create();

        $products = Product::select('id')->get();

        foreach($products as $product){
        	$url = 'https://lorempixel.com/640/480/?62480';
        	$product->addMediaFromUrl($url)
        	->toMediaCollection('products');
        }
    }
}
