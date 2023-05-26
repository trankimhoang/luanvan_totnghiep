<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateDataProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-data-product';

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
        $listProductIdsSimple = DB::table('products')
            ->where('type', '=', 'simple')
            ->pluck('id')
            ->toArray();
        DB::table('products')
            ->where('parent_id', '=', $listProductIdsSimple)
            ->delete();

        echo "\nsuccess\n";

        return 1;
    }
}
