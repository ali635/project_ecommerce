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


Route::get('/', 'HomeController@index')->name('home');


// Route::group(['middleware' => 'Maintenance'], function () {
//     Route::get('/', function () {
//         return view('style.home');
//     });
// });

// Route::get('test', function () {
//     return view('auth.login')->name('mohamed');
// });

// Route::get('maintenance', function () {
//     if(setting()->status == 'open')
//     {
//         return redirect('/');
//     }
//     return view('style.maintenance');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

