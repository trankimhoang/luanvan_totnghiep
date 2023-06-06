<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $listCity = json_decode(file_get_contents(storage_path('city.json')), true);
        $listCity = $listCity['data']['data'];
        $listCityInsert = [];

        foreach ($listCity as $city){
            $listCityInsert[] = [
                'name' => $city['name'],
                'code' => $city['code']
            ];
        }

        DB::table('city')->delete();
        DB::table('city')->insert($listCityInsert);


        return Command::SUCCESS;
    }
}
