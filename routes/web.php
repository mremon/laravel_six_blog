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

//Route::get('/', function () {
//    return view('pages.index');
//});
Route::get('/', 'pageController@index');
Route::get('about/us', 'pageController@about')->name('about');
Route::get('contact/us', 'pageController@contact')->name('contact');


// Category CRUD operation here...
Route::get('all/category', 'postController@allCategory')->name('all.category');
Route::get('add/category', 'postController@addCategory')->name('add.category');
Route::post('store/category', 'postController@storeCategory')->name('store.category');
Route::get('view/category/{id}', 'postController@viewCategory');
Route::get('delete/category/{id}', 'postController@deleteCategory');
Route::get('edit/category/{id}', 'postController@editCategory');
Route::post('update/category/{id}', 'postController@updateCategory');


// Post CRUD operation here...
Route::get('write/post', 'postController@writePost')->name('write.post');
Route::post('store/post', 'postController@storePost')->name('store.post');
Route::get('all/post', 'postController@allPost')->name('all.post');
Route::get('view/post/{id}', 'postController@viewPost');
Route::get('edit/post/{id}', 'postController@editPost');
Route::post('update/post/{id}', 'postController@updatePost');
Route::get('delete/post/{id}', 'postController@deletePost');