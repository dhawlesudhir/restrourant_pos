<?php
use Illuminate\Support\Facades\Auth;
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
Auth::routes();


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/manage', function() {
    return view('/manage.index');
});

Route::get('/cashier', function() {
    return view('/cashier.index');
});

Route::get('/reports', function() {
    return view('/reports.index');
});

Route::resource('manage/category','manage\CategoryController');
Route::resource('manage/menu','manage\MenuController');
Route::resource('manage/table','manage\TableController');