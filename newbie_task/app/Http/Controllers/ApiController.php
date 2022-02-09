<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class ApiController extends Controller
{
    public function myTaskCreate(Request $request)
    {
        $url = url()->previous();
        $uri = rtrim($url, '/');
        $uri = substr($uri, strrpos($uri, '/') + 1);

        $task = new Task();

        $task->user_id = $request->user_id;
        $task->task_name = $request->task_name;
        $task->task_body = $request->task_body;

        Log::debug('タスク:' . $task);

        Log::debug('ファイルexistチェック');
        if (!empty($request->task_img1)) {
            Log::debug('task_img1あり' . $request->task_img1);
            Log::debug($task);
            $file_name1 =
                time() . '_' . $request->task_img1->getClientOriginalName();
            Log::debug($file_name1);
            $request->task_img1->storeAs('public', $file_name1);

            $task->img1 = 'storage/' . $file_name1;
        }

        if (!empty($request->task_img2)) {
            Log::debug('task_img2あり' . $request->task_img2);
            Log::debug($task);
            $file_name2 =
                time() . '_2_' . $request->task_img2->getClientOriginalName();
            Log::debug($file_name2);
            $request->task_img2->storeAs('public', $file_name2);

            $task->img2 = 'storage/' . $file_name2;
        }

        if (!empty($request->task_img3)) {
            Log::debug('task_img3あり' . $request->task_img3);
            Log::debug($task);

            $file_name3 =
                time() . '_3_' . $request->task_img3->getClientOriginalName();
            Log::debug($file_name3);
            $request->task_img3->storeAs('public', $file_name3);

            $task->img3 = 'storage/' . $file_name3;
        }

        if ($uri == 'myTasks') {
            Log::debug($uri);
            $task->group_id = 0;

            // 外部キー制約を無効化
            Schema::disableForeignKeyConstraints();
            $task->save();
            // 外部キー制約を有効化
            Schema::enableForeignKeyConstraints();
        } else {
            $task->group_id = $request->group_id;
            $task->save();
        }

        return redirect(route('myTasks'));
    }
    public function myTaskEdit(Request $request)
    {
        $param = [
            'task_id' => $request->input('id'),
            'task_val' => $request->input('val'),
        ];

        DB::update(
            'UPDATE tasks SET ' .
                $request->input('column') .
                ' = :task_val WHERE id = :task_id',
            $param
        );

        return redirect(route('myTasks'));
    }

    public function myTaskEditImg(Request $request)
    {
        // Log::debug('ファイルexistチェック');

        if ($request->task_img1) {
            if ($request->task_img1 == 'null') {
                $param = [
                    'task_id' => $request->task_id,
                ];
                DB::update(
                    'UPDATE tasks SET img1 = null WHERE id = :task_id',
                    $param
                );
            } else {
                Log::debug('task_img1あり' . $request->task_img1);
                $file_name1 =
                    time() . '_' . $request->task_img1->getClientOriginalName();
                Log::debug($file_name1);
                $request->task_img1->storeAs('public', $file_name1);

                $param = [
                    'task_id' => $request->task_id,
                    'task_img1' => 'storage/' . $file_name1,
                ];

                DB::update(
                    'UPDATE tasks SET img1 = :task_img1 WHERE id = :task_id',
                    $param
                );
            }
        }

        if ($request->task_img2) {
            if ($request->task_img2 == 'null') {
                $param = [
                    'task_id' => $request->task_id,
                ];
                DB::update(
                    'UPDATE tasks SET img2 = null WHERE id = :task_id',
                    $param
                );
            } else {
                Log::debug('task_img2あり' . $request->task_img2);
                $file_name2 =
                    time() . '_' . $request->task_img2->getClientOriginalName();
                Log::debug($file_name2);
                $request->task_img2->storeAs('public', $file_name2);

                $param = [
                    'task_id' => $request->task_id,
                    'task_img2' => 'storage/' . $file_name2,
                ];

                DB::update(
                    'UPDATE tasks SET img2 = :task_img2 WHERE id = :task_id',
                    $param
                );
            }
        }

        if ($request->task_img3) {
            if ($request->task_img3 == 'null') {
                $param = [
                    'task_id' => $request->task_id,
                ];
                DB::update(
                    'UPDATE tasks SET img3 = null WHERE id = :task_id',
                    $param
                );
            } else {
                Log::debug('task_img3あり' . $request->task_img3);
                $file_name3 =
                    time() . '_' . $request->task_img3->getClientOriginalName();
                Log::debug($file_name3);
                $request->task_img3->storeAs('public', $file_name3);

                $param = [
                    'task_id' => $request->task_id,
                    'task_img3' => 'storage/' . $file_name3,
                ];

                DB::update(
                    'UPDATE tasks SET img3 = :task_img3 WHERE id = :task_id',
                    $param
                );
            }
        }

        return redirect(route('myTasks'));
    }

    public function myTaskDelete(Request $request)
    {
        $param = [
            'task_id' => $request->input('id'),
        ];

        DB::delete('DELETE FROM tasks WHERE id = :task_id', $param);

        return redirect(route('myTasks'));
    }

    public function taskImgShow(Request $request)
    {
        $taskImages = Task::find($request->input('task_id'));
        Log::debug('IMG画像：' . $taskImages);
        return $taskImages;
    }

    public function myTaskChangeState(Request $request)
    {
        $param = [
            'task_id' => $request->task_id,
        ];

        DB::update(
            'UPDATE tasks SET state_id = (state_id + 1) WHERE id = :task_id',
            $param
        );

        return redirect(route('myTasks'));
    }
}
