<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $columns = collect(['state']);
        $values = collect([['First'], ['Second'], ['Done'], ['Result']]);

        $rows = $values->map(fn($x) => $columns->combine($x))->toArray();

        DB::connection()
            ->table('states')
            ->insert($rows);
    }
}
