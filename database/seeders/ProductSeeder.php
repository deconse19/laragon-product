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
        
        Product::factory()->count(10)->create();
        // DB::table('products')->insert([
            
        // [   'name'=>'Star',
        //     'price' =>67.00,
        //     'description'=>'yieee',
        //     'created_at' =>Carbon::now(),
        //     'updated_at' =>Carbon::now(),
        // ],
        // [   'name'=>'asdfasd',
        //     'price' =>67.00,
        //     'description'=> 'yieee',
        //     'created_at' =>Carbon::now(),
        //     'updated_at' =>Carbon::now(),
        // ],
        // [   'name'=>'asdfaffffffffff',
        //     'price' =>67.00,
        //     'description'=> 'yieee',
        //     'created_at' =>Carbon::now(),
        //     'updated_at' =>Carbon::now(),
        // ],
        // [   'name'=>'aaaaaaaaaaaa',
        //     'price' =>67.00,
        //     'description'=> 'yieee',
        //     'created_at' =>Carbon::now(),
        //     'updated_at' =>Carbon::now(),
        // ],

        // ]);
    }
}
