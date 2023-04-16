<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        for ($i = 1; $i < 5; $i++){
            \Illuminate\Support\Facades\DB::table('admins')->insertOrIgnore([
                "name" => "admin " . $i,
                "email" => "admin" . $i . "@gmail.com",
                "password" =>\Illuminate\Support\Facades\Hash::make('123')
            ]);
        }
    }
}
