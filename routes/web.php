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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/addPage','ClientPageController@addPage')->name('addPage');
//Route::get('/dashboard/addPage' ) -> todo, redirect person to the dashboard page with addPage open
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//first pages to allow traffic to page
Route::get('/qtccrpbb', function () {
    return view('qtccrpbb');
});
