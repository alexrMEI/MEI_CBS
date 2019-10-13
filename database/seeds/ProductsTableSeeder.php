<?php

use App\Product;
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
        Product::create([
        	'name' => 'Product 1',
            'price' => 79.99,
            'description' => ''            
        ]);
        Product::create([
        	'name' => 'Product 2',
            'price' => 89.99,
            'description' => ''
        ]);
        Product::create([
        	'name' => 'Product 3',
            'price' => 99.99,
            'description' => ''
        ]);
        Product::create([
        	'name' => 'Product 4',
            'price' => 129.99,
            'description' => ''
        ]);
    }
}
