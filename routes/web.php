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


//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('/posts_test', 'PostController@indexTest');
Route::get('/all_posts', 'PostController@all_posts');
Route::get('/title_posts', 'PostController@all_title_posts');
Route::get('publ_posts', 'PostController@publ_posts');

Route::get('posts/create_test', 'PostController@createTest');
Route::get('posts/update_test', 'PostController@updateTest');
Route::get('posts/delete_test', 'PostController@deleteTest');
Route::get('posts/restore', 'PostController@restore');
Route::get('posts/first_or_create','PostController@firstOrCreate');
Route::get('posts/update_or_create','PostController@updateOrCreate');

Route::get('posts/upd_or_crt','PostController@updOrCrt');


// работа со View

Route::group(['namespace' => 'Post'], function() {
    Route::get('/posts', 'IndexController')->name('post.index');
    Route::get('/posts/create', 'CreateController')->name('post.create');
    Route::post('/posts', 'StoreController')->name('post.store');
    Route::get('/posts/{post}', 'ShowController')->name('post.show');
    Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
    Route::delete('/posts/{post}', 'DeleteController')->name('post.delete');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::group(['namespace' => 'Post'], function() {
        Route::get('/posts', 'IndexController')->name('admin.post.index');
    });
});



Route::get('/main', 'MainController@index')->name('main.index');
Route::get('/contacts', 'ContactController@index')->name('contact.index');
Route::get('/about', 'AboutController@index')->name('about.index');



