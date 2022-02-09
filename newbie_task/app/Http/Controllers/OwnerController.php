<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    public function imgUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            $group = Group::find(
                $request->session()->get('groupData')[0]['group_id']
            );

            $img1 = $group->img1;
            $img2 = $group->img2;
            $img3 = $group->img3;

            if (!empty($request->img1)) {
                $file_name1 =
                    time() . '_' . $request->img1->getClientOriginalName();
                $request->img1->storeAs('public', $file_name1);

                $group->img1 = 'storage/' . $file_name1;

                $img1 = $group->img1;
            }
            if (!empty($request->img2)) {
                $file_name2 =
                    time() . '_' . $request->img2->getClientOriginalName();
                $request->img2->storeAs('public', $file_name2);

                $group->img2 = 'storage/' . $file_name2;

                $img2 = $group->img2;
            }

            if (!empty($request->img3)) {
                $file_name3 =
                    time() . '_' . $request->img3->getClientOriginalName();
                $request->img3->storeAs('public', $file_name3);

                $group->img3 = 'storage/' . $file_name3;

                $img3 = $group->img3;
            }

            $group->save();

            if (!empty($request->session()->get('groupData'))) {
                $request->session()->forget('groupData');
            }
            $groupData = [
                'group_id' => $group->id,
                'user_id' => $group->user_id,
                'group_name' => $group->group_name,
                'img1' => $img1,
                'img2' => $img2,
                'img3' => $img3,
            ];
            $request->session()->push('groupData', $groupData);

            return redirect('/group');
        }

        return view('groups.owner');
    }
}
