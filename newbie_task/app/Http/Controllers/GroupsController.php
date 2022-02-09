<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GroupsController extends Controller
{
    public function register(Request $request)
    {
        $auth_user_id = Auth::id();

        $validator = Validator::make($request->all(), [
            'group_name' => ['required', 'string', 'max:255', 'unique:groups'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'img1' => ['max:10240|mimes:jpg,jpeg,png'],
            'img2' => ['max:10240|mimes:jpg,jpeg,png'],
            'img3' => ['max:10240|mimes:jpg,jpeg,png'],
        ]);

        // バリデーションに失敗したら
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            // 成功したら
            $group = new Group();
            $group->user_id = $auth_user_id;
            $group->group_name = $request->group_name;
            $group->password = Hash::make($request['password']);

            if (!empty($request->img1)) {
                $file_name1 =
                    time() . '_' . $request->img1->getClientOriginalName();
                $request->img1->storeAs('public', $file_name1);

                $group->img1 = 'storage/' . $file_name1;
            }
            if (!empty($request->img2)) {
                $file_name2 =
                    time() . '_' . $request->img2->getClientOriginalName();
                $request->img2->storeAs('public', $file_name2);

                $group->img2 = 'storage/' . $file_name2;
            }
            if (!empty($request->img3)) {
                $file_name3 =
                    time() . '_' . $request->img3->getClientOriginalName();
                $request->img3->storeAs('public', $file_name3);

                $group->img3 = 'storage/' . $file_name3;
            }
            $group->save();

            $last_insert_id = $group->id;

            if (!empty($request->session()->get('groupData'))) {
                $request->session()->forget('groupData');
            }

            // グローバルな"session"ヘルパ経由
            $groupData = [
                'group_id' => $last_insert_id,
                'user_id' => $auth_user_id,
                'group_name' => $request->group_name,
                'img1' => $group->img1,
                'img2' => $group->img2,
                'img3' => $group->img3,
            ];
            // $_SESSION['groupData'] = $groupData;
            $request->session()->push('groupData', $groupData);

            return redirect('/group');
        }
        return view('groups.register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $param = [
                'group_name' => $request->group_name,
            ];
            $result = DB::select(
                'SELECT password, id, user_id, img1, img2, img3 FROM groups g WHERE group_name = :group_name',
                $param
            );

            if (
                $result &&
                Hash::check($request->password, $result[0]->password)
            ) {
                if (!empty($request->session()->get('groupData'))) {
                    $request->session()->forget('groupData');
                }
                $groupData = [
                    'group_id' => $result[0]->id,
                    'user_id' => $result[0]->user_id,
                    'group_name' => $request->group_name,
                    'img1' => $result[0]->img1,
                    'img2' => $result[0]->img2,
                    'img3' => $result[0]->img3,
                ];
                $request->session()->push('groupData', $groupData);
                return redirect('/group');
            } else {
                return redirect()
                    ->back()
                    ->withErrors($validator->errors())
                    ->withInput();
            }
        }
        return view('groups.login');
    }
}
