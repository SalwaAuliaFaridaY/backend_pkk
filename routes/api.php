<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//tambahkan ini
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login'); //do login

Route::middleware(['jwt.verify'])->group(function(){
  Route::get('login/check', "UserController@LoginCheck"); //cek token
  Route::post('logout', "UserController@logout"); //cek token
  
  Route::get('/pemesanan', 'PemesananController@index');
  Route::get('/pemesanan/{id}', 'PemesananController@show');
  Route::post('/pemesanan', 'PemesananController@store');
  Route::delete('/pemesanan/{id}', 'PemesananController@delete');

  Route::get('/admin', 'AdminController@index');
  Route::get('admin/{limit}/{offset}', "AdminController@getAll"); //read poin
  Route::post('/admin', 'AdminController@store');
  Route::put('admin/{id}', "AdminController@update"); //update pelanggaran
  Route::delete('/admin/{id}', 'AdminController@delete');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
