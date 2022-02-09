<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TasksController extends Controller
{
    public function taskList(Request $request)
    {
        // dd($request->session()->get('groupData', []));
        $auth_user_id = Auth::id();
        $currentRouteName = Route::currentRouteName();

        $group_id = '';
        $group_name = '';
        $group_img1 = '';
        $group_img2 = '';
        $group_img3 = '';
        if ($request->session()->get('groupData')) {
            $ses_group = $request->session()->get('groupData')[0];
            $group_id = $ses_group['group_id'];
            $group_name = $ses_group['group_name'];
            $group_img1 = $ses_group['img1'];
            $group_img2 = $ses_group['img2'];
            $group_img3 = $ses_group['img3'];
        }

        if (
            $request->session()->get('groupData') &&
            $currentRouteName == 'home_group'
        ) {
            $newbie_tasks = DB::select(
                "SELECT
                    u.id,
                    u.name,
                    COUNT(CASE WHEN t.state_id = 1 THEN t.state_id END) AS 未確定,
                    COUNT(CASE WHEN t.state_id = 2 THEN t.state_id END) AS 確定,
                    COUNT(CASE WHEN t.state_id = 3 THEN t.state_id END) AS 完了
                FROM users u
                LEFT JOIN tasks t ON u.id = t.user_id
                WHERE group_id = $group_id
                GROUP BY u.id
                ORDER BY u.id"
            );
        } elseif ($currentRouteName == 'home') {
            $newbie_tasks = DB::select(
                "SELECT 
                    u.id,
                    u.name, 
                    COUNT(CASE WHEN t.state_id = 1 THEN t.state_id END) AS 未確定,
                    COUNT(CASE WHEN t.state_id = 2 THEN t.state_id END) AS 確定,
                    COUNT(CASE WHEN t.state_id = 3 THEN t.state_id END) AS 完了
                FROM users u
                LEFT JOIN tasks t ON u.id = t.user_id 
                WHERE t.user_id = $auth_user_id
                AND t.group_id = 0
                GROUP BY u.id
                ORDER BY u.id"
            );
        }
        return view(
            'home',
            compact(
                'newbie_tasks',
                'group_name',
                'group_img1',
                'group_img2',
                'group_img3'
            )
        );
    }

    public function myTasks(Request $request)
    {
        // 現在認証しているユーザーを取得
        $user = Auth::user();
        $userName = $user->name;

        // 現在認証しているユーザーのIDを取得
        $user_id = Auth::id();
        $auth_user_id = Auth::id();

        $currentRouteName = Route::currentRouteName();

        $group_id = '';
        $group_name = '';
        if (!empty($request->session()->get('groupData')[0])) {
            $ses_group = $request->session()->get('groupData')[0];
            $group_id = $ses_group['group_id'];
            $group_name = $ses_group['group_name'];
        }

        if ($currentRouteName == 'group_myTasks') {
            $not_decided = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 1)
                ->where('group_id', '=', $group_id)
                ->orderBy('t.updated_at', 'desc')
                ->get();

            $decided = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 2)
                ->where('group_id', '=', $group_id)
                ->orderBy('t.updated_at', 'desc')
                ->get();

            $done = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 3)
                ->where('group_id', '=', $group_id)
                ->orderBy('t.updated_at', 'desc')
                ->get();
            $group_name = $group_name;
        } elseif ($currentRouteName == 'myTasks') {
            $not_decided = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 1)
                ->where('group_id', '=', 0)
                ->orderBy('t.updated_at', 'desc')
                ->get();

            $decided = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 2)
                ->where('group_id', '=', 0)
                ->orderBy('t.updated_at', 'desc')
                ->get();

            $done = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 3)
                ->where('group_id', '=', 0)
                ->orderBy('t.updated_at', 'desc')
                ->get();

            $group_id = 0;
            $group_name = '';
        }

        return view(
            'tasks.userTasks',
            compact(
                'not_decided',
                'decided',
                'done',
                'auth_user_id',
                'userName',
                'group_name',
                'group_id'
            )
        );
    }

    public function userTasks(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $userName = $user->name;

        $auth_user_id = Auth::id();
        $currentRouteName = Route::currentRouteName();

        $group_id = '';
        $group_name = '';

        $url = url()->previous();
        $uri = rtrim($url, '/');
        $uri = substr($uri, strrpos($uri, '/') + 1);

        if (!empty($request->session()->get('groupData')[0])) {
            $ses_group = $request->session()->get('groupData')[0];
            $group_id = $ses_group['group_id'];
            $group_name = $ses_group['group_name'];
        }

        if ((int) $user_id == (int) $auth_user_id && $uri == 'home') {
            return redirect('/myTasks');
        } elseif ((int) $user_id == (int) $auth_user_id && $uri == 'group') {
            return redirect('/group_myTasks');
        }

        if ($currentRouteName == 'userTasks') {
            $not_decided = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 1)
                ->where('group_id', '=', $group_id)
                ->orderBy('t.updated_at', 'desc')
                ->get();

            $decided = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 2)
                ->where('group_id', '=', $group_id)
                ->orderBy('t.updated_at', 'desc')
                ->get();

            $done = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 3)
                ->where('group_id', '=', $group_id)
                ->orderBy('t.updated_at', 'desc')
                ->get();

            $done = DB::table('tasks AS t')
                ->select(
                    't.id AS task_id',
                    't.user_id',
                    't.state_id',
                    't.task_name',
                    't.task_body',
                    't.img1',
                    't.img2',
                    't.img3'
                )
                ->join('users AS u', 't.user_id', '=', 'u.id')
                ->where('t.user_id', '=', $user_id)
                ->where('t.state_id', '=', 3)
                ->where('t.group_id', '=', $group_id)
                ->get();
        }

        return view(
            'tasks.userTasks',
            compact(
                'not_decided',
                'decided',
                'done',
                'auth_user_id',
                'userName',
                'group_name',
                'group_id',
                'user_id'
            )
        );
    }
}
