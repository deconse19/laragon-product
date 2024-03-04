<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;




class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $products = [
            [
                'name' => 'mouse',
                'description' => 'Description for Product 1',
                'price' => 10.99,
                'created_at' => now(),
                'updated_at' => now(),
                'confirmed'=> true
            ],
            [
                'name' => 'keyboard',
                'description' => 'Description for Product 1',
                'price' => 10.99,
                'created_at' => now(),
                'updated_at' => now(),
                'confirmed'=> false
            ],
            [
                'name' => 'eyebrow',
                'description' => 'Description for Product 3',
                'price' => 10.99,
                'created_at' => now(),
                'updated_at' => now(),
                'confirmed'=> true
            ],
            [
                'name' => 'ball',
                'description' => 'Description for Product 4',
                'price' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
                'confirmed'=> true
            ],[
                'name' => 'desktop',
                'description' => 'Description for Product 5',
                'price' => 10.99,
                'created_at' => now(),
                'updated_at' => now(),
                'confirmed'=> false
            ],
            [
                'name' => 'bread',
                'description' => 'Description for Product 6',
                'price' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
                'confirmed'=> false
            ],
            // Add more products as needed
        ];

        // Insert the products into the database
        DB::table('products')->insert($products);
       
    }
}
