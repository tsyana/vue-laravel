<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/api/fetch', 'OfoController@doFetch');
// Route::get('/api/articleBrief/list', 'ArticleBriefController@getList');
Route::get('/api/articleBrief/category', 'OfoController@getCategory');
Route::get('/api/articleBrief/getPassword', 'OfoController@getPassword');
