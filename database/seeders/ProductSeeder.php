<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        for ($i = 1; $i < 5; $i++){
            \Illuminate\Support\Facades\DB::table('products')->insertOrIgnore([
                "name" => "product " . $i,
                "price" => 1000,
                "quantity" => 2
            ]);
        }
    }
}
