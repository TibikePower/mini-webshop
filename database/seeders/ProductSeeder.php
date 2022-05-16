<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<1000;$i++){
            $price = rand(500,100000);
            $sale_price = (int)$price/2;
            DB::table('products')->insert([
                'name' => Str::random(10),
                'description' => Str::random(30),
                'price' => $price,
                'sale_price' => $sale_price,
                'stock' => rand(0,100),
                'available' => rand(0,1),
                'image' => '/img/dummy.png',
                'created_at' => now()
            ]);
        }
    }
}
