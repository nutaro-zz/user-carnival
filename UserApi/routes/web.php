<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('/', function () {

});

Route::get('/user/all', function () {
    return UserController::getAll();
});


Route::get('/user/([0-9]*)', function () {
    return UserController::get();
});

Route::post('/user', function () {
    return UserController::post();
});


Route::put('/user/([0-9]*)', function () {

});

Route::delete('/user/([0-9]*)', function () {

});
