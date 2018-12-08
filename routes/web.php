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

//Dashboard routes
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/{PageName}', 'DashboardController@dashboardPage')->name('dashboard');
Route::get('/dashboard/editpage/{PageId}','ClientPageController@editPage')->name('editPage');
Route::get('/dashboard/edittheme/{ThemeId}','ThemeController@editTheme')->name('editTheme');
Route::post('/dashboard/edittheme','ThemeController@store')->name('saveTheme');
//Ajax routes for dashboard
Route::get('addPage','ClientPageController@addPage')->name('addPage')->middleware('ajax');
Route::get('addTheme','ThemeController@addTheme')->name('addTheme')->middleware('ajax');
Route::get('loadPagesList','ClientPageController@loadPagesList')->name('loadPagesList')->middleware('ajax');
Route::get('loadThemesList','ThemeController@loadThemesList')->name('loadThemesList')->middleware('ajax');
Route::get('getAllThemes','ThemeController@getAllThemes')->name('getAllThemes');
Route::get('publishPage','ClientPageController@publishUserPage')->name('publishUserPage')->middleware('ajax');

//TODO: Browse routes
Route::get('/browse/{userName}/{pageName}','BrowseController@displayPage')->name('displayUserPage');
//Preview routes
Route::get('/preview/{userName}/{pageName}','ClientPageController@showPreview')->name('displayPreviewPage');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//summernote store route
Route::post('/dashboard/addPage','ClientPageController@store')->name('summernotePersist');
//summernote update route
Route::post('/dashboard/editPage','ClientPageController@updateOrPublish')->name('updateOrPublish');
//summernote display route
Route::get('/dashboard/addPage','ClientPageController@show')->name('summernoteDisplay');

//first pages to allow traffic to page
Route::get('/qtccrpbb', function () {
    return view('qtccrpbb');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
