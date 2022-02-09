<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'tel' => [
                'required',
                'numeric',
                'digits_between:8, 11',
                'unique:users',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function editPage(Request $request)
    {
        $user = Auth::user();

        return view('auth.userEdit', compact('user'));
    }

    public function edit(Request $request)
    {
        $auth_user_id = Auth::id();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'numeric', 'digits_between:8, 11'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        // バリデーションに失敗したら
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            // 成功したら
            $user = User::find($auth_user_id);
            $user->name = $request->name;
            $user->kana = $request->kana;
            $user->tel = $request->tel;
            $user->email = $request->email;
            $user->save();

            return redirect('/myTasks');
        }
    }

    public function scaleImg(Request $request)
    {
        return view('auth.scale');
    }
}
