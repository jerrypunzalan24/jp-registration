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

Route::get('/', 'HomeController@index');
Route::post('/create', 'HomeController@create');
Route::any('/login','AdminController@login');
Route::group(['prefix'=>'admin', 'middleware'=>'login_required'],function(){
  Route::get('/','AdminController@index');
  Route::get('/logout','AdminController@logout');
  Route::post('/edit','AdminController@edit');
  Route::post('/delete','AdminController@delete');
  Route::post('/getdata','AjaxController@getEditData');
});
