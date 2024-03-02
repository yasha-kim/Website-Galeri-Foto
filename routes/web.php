<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LikeController;
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

Route::get('/form', 'FormController@index')->name('form');
Route::get('/like/{id}', 'LikeController@like')->name('like');
Route::post('/store', 'FormController@store')->name('store');
// User Functionalities
Route::get('/form/update/{id}', 'FormController@update_form')->name('update-form');
Route::get('/delete/{id}', 'FormController@delete')->name('delete');
Route::post('/update', 'FormController@update')->name('update');

Route::post('/album', [AlbumController::class, 'store'])->name('album.store');
Route::get('/{albumSlug}', [AlbumController::class, 'show'])->name('album.show');

Route::get('/pin/{id}', [FormController::class, 'show'])->name('pin.show');

// Route::post('/pin/{post_id}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
