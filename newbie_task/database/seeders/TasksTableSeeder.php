<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $columns = collect([
            'user_id',
            'group_id',
            'state_id',
            'task_name',
            'task_body',
            'created_at',
            'updated_at',
        ]);
        $values = collect([
            [
                2,
                2,
                1,
                'サンプル1',
                'サンプルbody1 サンプルbody1
            サンプルbody1サンプルbody1
            サンプルbody1サンプルbody1サンプルbody1
            サンプルbody1サンプルbody1サンプルbody1サンプルbody1サンプルbody1サンプルbody1サンプルbody1サンプルbody1サンプルbody1
            サンプルbody1サンプルbody1
            サンプルbody1
            サンプルbody1
            サンプルbody1
            
            
            サンプルbody1
            サンプルbody1
            サンプルbody1
            サンプルbody1
            サンプルbody1
            サンプルbody1
            サンプルbody1',
                Carbon::now(),
                Carbon::now(),
            ],
            [
                1,
                0,
                1,
                'サンプル2',
                'グループ無し',
                Carbon::now(),
                Carbon::now(),
            ],
            [2, 1, 2, 'サンプル3', 'サンプル3', Carbon::now(), Carbon::now()],
            [2, 1, 3, 'サンプル4', 'サンプル4', Carbon::now(), Carbon::now()],
            [
                1,
                0,
                3,
                'サンプル5',
                'グループ無し',
                Carbon::now(),
                Carbon::now(),
            ],
            [2, 1, 3, 'サンプル6', 'ppppp', Carbon::now(), Carbon::now()],
            [
                1,
                0,
                1,
                'サンプル7',
                'グループ無し',
                Carbon::now(),
                Carbon::now(),
            ],
            [2, 1, 1, 'サンプル8', 'サンプル8', Carbon::now(), Carbon::now()],
            [2, 1, 1, 'サンプル9', 'サンプル9', Carbon::now(), Carbon::now()],
        ]);

        $rows = $values->map(fn($x) => $columns->combine($x))->toArray();

        DB::connection()
            ->table('tasks')
            ->insert($rows);
    }
}
