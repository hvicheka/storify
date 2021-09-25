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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','Auth\LoginController@ShowLoginForm');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

route::middleware(['auth'])->group(function(){
    // Route::get('/stories','StoriesController@index')->name('stories.index');
    // Route::get('/stories/{story}','StoriesController@show')->name('stories.show');
    Route::resource('stories', 'StoriesContoller');
});

Route::get('/','DashboardController@index')->name('dashboard.index');
Route::get('/story/{activeStory:slug}','DashboardController@show')->name('dashboard.show'); 
Route::get('/email','DashboardController@email')->name('dashboard.email');