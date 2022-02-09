<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('entrance');
})->name('entrance');

// home
Route::get('/home', 'App\Http\Controllers\TasksController@taskList')
    ->name('home')
    ->middleware('auth');

Route::get('/group', 'App\Http\Controllers\TasksController@taskList')
    ->name('home_group')
    ->middleware('auth');

Auth::routes();

Route::get('/userEdit', 'App\Http\Controllers\Auth\UserController@editPage')
    ->name('userEdit')
    ->middleware('auth');
Route::post('/userEdit', 'App\Http\Controllers\Auth\UserController@edit')
    ->name('userEdit')
    ->middleware('auth');

//パスワードリセット
Route::get(
    'password/reset',
    'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm'
)->name('password.request');
Route::post(
    'password/email',
    'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail'
)->name('password.email');
Route::get(
    'password/reset/{token}',
    'App\Http\Controllers\Auth\ResetPasswordController@showResetForm'
)->name('password.reset');
Route::post(
    'password/reset',
    'App\Http\Controllers\Auth\ResetPasswordController@reset'
)->name('password.resetPost');

// グループ
Route::get('/group_register', function () {
    return view('groups.register');
})
    ->name('group_register')
    ->middleware('auth');
Route::post('/group_register', 'App\Http\Controllers\GroupsController@register')
    ->name('group_register_post')
    ->middleware('auth');
Route::get('/group_login', function () {
    return view('groups.login');
})
    ->name('group_login')
    ->middleware('auth');
Route::post('/group_login', 'App\Http\Controllers\GroupsController@login')
    ->name('group_login_post')
    ->middleware('auth');
Route::get('/group_myTasks', 'App\Http\Controllers\TasksController@myTasks')
    ->name('group_myTasks')
    ->middleware('auth');
Route::get('/owner', function () {
    return view('groups.owner');
})
    ->name('owner')
    ->middleware('auth');
Route::post('/owner', 'App\Http\Controllers\OwnerController@imgUpdate')
    ->name('imgUpdate')
    ->middleware('auth');

// タスク
Route::get('/myTasks', 'App\Http\Controllers\TasksController@myTasks')
    ->name('myTasks')
    ->middleware('auth');
Route::get(
    'userTasks/{user_id}',
    'App\Http\Controllers\TasksController@userTasks'
)
    ->name('userTasks')
    ->middleware('auth');

Route::get('/result', 'App\Http\Controllers\ResultController@result')
    ->name('result')
    ->middleware('auth');

Route::get(
    '/group_result',
    'App\Http\Controllers\ResultController@group_result'
)
    ->name('group_result')
    ->middleware('auth');
Route::get('/result/{yearMonth}', 'App\Http\Controllers\ResultController@day')
    ->name('day')
    ->middleware('auth');
Route::get(
    '/group_result/{yearMonth}',
    'App\Http\Controllers\ResultController@groupDay'
)
    ->name('group_day')
    ->middleware('auth');


