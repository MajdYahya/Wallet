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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/admin', 'HomeController@index')->name('home');

// Route::get('/admin', function ($id) {
//     return 'Admin User Route' ;
// })->middlware('role:admin');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', function () {
        // Uses first & second Middleware
        return 'Admin User Route';
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});
Route::middleware(['role:user'])->group(function () {
    Route::get('/user', function () {
        // Uses first & second Middleware
        return 'Admin User Route';
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});