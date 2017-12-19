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


/*Route::get('/', function () {
    return view('auth/login');
});*/


/*
Route::get('/', function () {
    return view('layouts.app');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::get('/profile', 'profileController@index');


Route::get('/registration','registrationController@index');
Route::post('/registration','registrationController@teacherRegs');

Route::get('/course_reg', function (){
    return view('course_reg');
});

Route::get('/teacher', function (){
    return view('teacher');
});
