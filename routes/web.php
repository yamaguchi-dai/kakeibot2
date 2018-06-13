<?php

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
    return redirect('home');
});

//ログイン画面要求
Route::get('login','Web\LoginController@index');
//ログイン認証
Route::post('login','Web\LoginController@login');
//ログアウト
Route::get('logout','Web\LoginController@logout');

//ワンタイムパスワード利用
Route::get('/onetime/auth/{onetime}', 'Web\OntimeUrlController@auth');
//ワンタイム認証後
Route::get('AccountCreate/{line_id}','Web\AccountController@index');
//アカウント登録
Route::post('AccountCreate','Web\AccountController@create');

//ログイン後画面
Route::middleware(['auth'])->group(function () {
    
    //ホーム画面
    Route::get('home','Web\HomeController@index');
    
    //予算管理画面
    Route::get('budget', 'Web\BudgetController@index');
    //予算登録
    Route::post('budget', 'Web\BudgetController@regist');
    //予算更新
    Route::post('budget/update', 'Web\BudgetController@update');

    //支払い一覧
    Route::get('payment', 'Web\PaymentController@index');
    //支払い登録
    Route::post('payment', 'Web\PaymentController@regist');

});



