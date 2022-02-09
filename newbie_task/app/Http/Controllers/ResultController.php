<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function result(Request $request)
    {
        $auth_user_id = Auth::id();
        $results = DB::select(
            "SELECT
              DATE_FORMAT(updated_at, '%Y-%m') as regist_time,
              COUNT(*) as count
          FROM
              tasks
          WHERE state_id = 4
          AND group_id = 0
          AND user_id = $auth_user_id
          GROUP BY
              regist_time
          ORDER BY 
              regist_time DESC"
        );

        return view('results.result', compact('results'));
    }

    public function group_result(Request $request)
    {
        $group_id = $request->session()->get('groupData')[0]['group_id'];

        $results = DB::select(
            "SELECT
            DATE_FORMAT(updated_at, '%Y-%m') as regist_time,
            COUNT(*) as count
        FROM
            tasks
        WHERE state_id = 4
        AND group_id = :group_id
        GROUP BY
            regist_time
        ORDER BY 
            regist_time DESC",
            [
                'group_id' => $group_id,
            ]
        );
        return view('results.result', compact('results'));
    }

    public function day(Request $request, $yearMonth)
    {
        $auth_user_id = Auth::id();

        $results = DB::select(
            "SELECT t.id AS task_id, u.name AS user_name, t.task_name, t.task_body, t.img1, t.img2, t.img3, DATE_FORMAT(t.updated_at, '%Y-%m') AS ym, DATE_FORMAT(t.updated_at, '%d日 %H:%i') AS dayTime
            FROM tasks t
            LEFT JOIN users u ON t.user_id = u.id
            WHERE t.user_id = :authId
            AND state_id = 4
            AND group_id = 0
            AND DATE_FORMAT(t.updated_at, '%Y-%m') = :yearMonth
            ORDER BY t.updated_at DESC
            ",
            ['authId' => $auth_user_id, 'yearMonth' => $yearMonth]
        );

        $group_id = 0;
        $resultUrl = '/result/' . $yearMonth;

        return view(
            'results.day',
            compact(
                'yearMonth',
                'results',
                'auth_user_id',
                'group_id',
                'resultUrl'
            )
        );
    }

    public function groupDay(Request $request, $yearMonth)
    {
        $auth_user_id = Auth::id();
        $group_id = $request->session()->get('groupData')[0]['group_id'];

        $results = DB::select(
            "SELECT t.id AS task_id, u.name AS user_name, t.task_name, t.task_body, t.img1, t.img2, t.img3, DATE_FORMAT(t.updated_at, '%Y-%m') AS ym, DATE_FORMAT(t.updated_at, '%d日 %H:%i') AS dayTime
            FROM tasks t
            LEFT JOIN users u ON t.user_id = u.id
            WHERE state_id = 4
            AND group_id = :group_id
            AND DATE_FORMAT(t.updated_at, '%Y-%m') = :yearMonth
            ORDER BY t.updated_at DESC
            ",
            ['group_id' => $group_id, 'yearMonth' => $yearMonth]
        );
        $resultUrl = '/result/' . $yearMonth;

        return view(
            'results.day',
            compact(
                'yearMonth',
                'results',
                'auth_user_id',
                'group_id',
                'resultUrl'
            )
        );
    }
}
