<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->truncate();
        for ($i = 1; $i < 5; $i++){
            \Illuminate\Support\Facades\DB::table('attributes')->insertOrIgnore([
                "name" => "attribute " . $i
            ]);
        }
    }
}
