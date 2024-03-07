<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;


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
// Guest Functionalities
Route::get('/', 'IndexController@index')->name('index');
Route::get('/download/{id}', 'IndexController@download')->name('download');
// Authenticated User Functionalities
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

//Route Post | Like | Komentar
Route::get('/form', 'FormController@index')->name('form');
Route::post('/store', 'FormController@store')->name('store');
Route::get('/post/{id}', 'FormController@show_post')->name('pin.show');
Route::get('/post/{id}/user','FormController@show')->name('pin-user.show');
Route::put('/update/{id}', 'FormController@update')->name('update');
Route::get('/delete/{id}', 'FormController@delete')->name('delete');
Route::get('/post/search', 'FormController@search')->name('search');
Route::get('/like/{id}', 'LikeController@like')->name('like');
Route::post('/post/{post_id}/comment', [CommentController::class, 'store'])->name('comment.store');

//Route Album
Route::post('/album', 'AlbumController@store')->name('album.store');
Route::get('/{albumSlug}', 'AlbumController@show')->name('album.show');


