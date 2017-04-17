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
  echo "2";
    // return view('welcome');
});
Route::get('/api/articleBrief/getPassword', 'OfoController@getPassword');
Route::get('/api/fetch', 'OfoController@doFetch');
// Route::get('/api/articleBrief/list', 'ArticleBriefController@getList');
Route::get('/api/articleBrief/category', 'OfoController@getCategory');
Route::post('/api/insertPassword','OfoController@insertPassword');
