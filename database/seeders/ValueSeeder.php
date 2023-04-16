<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('values')->truncate();
        for ($i = 1; $i < 5; $i++){
            \Illuminate\Support\Facades\DB::table('values')->insertOrIgnore([
                "entity_id" => 2,
                "attribute_id" => 1,
                "text_value" => "red",
                "quantity" => 3,
                "price" => 2000
            ]);
        }
    }
}
