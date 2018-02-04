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

Route::get('/', 'IndexController@index');
Route::get('/dashboard', 'DashboardController@index');

Route::group(['prefix' => 'user', 'middleware' => ['middleware' => 'user']], function () {
    Route::match(['get', 'post'], 'reports/', 'ReportsController@index');
    Route::post('reports/save', 'ReportsController@store');
});

Route::get('report/edit/{id}', 'ReportsController@edit')->middleware('auth');
Route::put('report/update', 'ReportsController@update')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => ['middleware' => 'admin']], function () {
    Route::get('/', 'Admin\UserListController@index');
    Route::match(['get', 'post'], '/reports/{id}', 'Admin\UserReportsController@index');
    Route::get('delete/{id}', 'Admin\UserListController@fullUserDelete');

    //change user data
    Route::post('change-login/{id}', 'Admin\UserReportsController@changeLogin');
    Route::post('change-password/{id}', 'Admin\UserReportsController@changePassword');
});

Auth::routes();
