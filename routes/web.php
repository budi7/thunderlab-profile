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


// Frontend
Route::get('/', 'frontendController@index')->name('frontend.home');
Route::get('/home', 'frontendController@index');
Route::get('/portofolio', 'frontendController@portofolio')->name('frontend.portofolio');
Route::get('/career', 'frontendController@career')->name('frontend.career');
Route::get('/contacts', 'frontendController@contacts')->name('frontend.contacts');
Route::post('/contacts', 'frontendController@writeGuestbook')->name('frontend.contacts.post');
Route::get('/tes', 'frontendController@tes')->name('frontend.contacts.tes');


// Backend
Route::prefix('dashboard')->group(function () {
	Route::get('/', 'dashboardController@index')->name('backend.dashboard');
	
    Route::resource('/user', 'userController', ['names' => [
		'index' 	=> 'backend.user.index', 
		'create' 	=> 'backend.user.create', 
		'store' 	=> 'backend.user.store', 
		'show' 		=> 'backend.user.show', 
		'edit' 		=> 'backend.user.edit', 
		'update' 	=> 'backend.user.update',
		'destroy' 	=> 'backend.user.destroy',
	]]);
	
    Route::resource('/portofolio', 'portofolioController', ['names' => [
		'index' 	=> 'backend.portofolio.index', 
		'create' 	=> 'backend.portofolio.create', 
		'store' 	=> 'backend.portofolio.store', 
		'show' 		=> 'backend.portofolio.show', 
		'edit' 		=> 'backend.portofolio.edit', 
		'update' 	=> 'backend.portofolio.update',
		'destroy' 	=> 'backend.portofolio.destroy',
	]]);
	
	Route::resource('/career', 'careerController', ['names' => [
		'index' 	=> 'backend.career.index', 
		'create' 	=> 'backend.career.create', 
		'store' 	=> 'backend.career.store', 
		'show' 		=> 'backend.career.show', 
		'edit' 		=> 'backend.career.edit', 
		'update' 	=> 'backend.career.update',
		'destroy' 	=> 'backend.career.destroy',
	]]);
	
	Route::resource('/blog', 'blogController', ['names' => [
		'index' 	=> 'backend.blog.index', 
		'create' 	=> 'backend.blog.create', 
		'store' 	=> 'backend.blog.store', 
		'show' 		=> 'backend.blog.show', 
		'edit' 		=> 'backend.blog.edit', 
		'update' 	=> 'backend.blog.update',
		'destroy' 	=> 'backend.blog.destroy',
	]]);

	Route::resource('/guestbook', 'guestbookController', ['names' => [
		'index' 	=> 'backend.guestbook.index', 
		'create' 	=> 'backend.guestbook.create', 
		'store' 	=> 'backend.guestbook.store', 
		'show' 		=> 'backend.guestbook.show', 
		'edit' 		=> 'backend.guestbook.edit', 
		'update' 	=> 'backend.guestbook.update',
		'destroy' 	=> 'backend.guestbook.destroy',
	]]);

	Route::get('/config', 'configController@create')->name('backend.config.create');
	Route::post('/config', 'configController@store')->name('backend.config.store');
	

	Route::post('/media/uploader', 'mediaController@upload')->name('backend.media.upload');


});