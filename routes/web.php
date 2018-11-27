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
Route::get('/portofolios', 'frontendController@portofolio')->name('frontend.portofolio');
Route::get('/career', 'frontendController@career')->name('frontend.career');
Route::get('/contacts', 'frontendController@contacts')->name('frontend.contacts');
Route::post('/contacts', 'frontendController@writeGuestbook')->name('frontend.contacts.post');

// Backend
Route::prefix('dashboard')->group(function () {
	Route::get('/login', 'UACController@login')->name('backend.login');
	Route::post('/login', 'UACController@logging')->name('backend.logging');
	Route::get('/logout', 'UACController@logout')->name('backend.logout');
	
	// Authed User Only
	Route::group(['middleware' => ['auth']], function(){
		Route::get('/', 'dashboardController@index')->name('backend.dashboard');
		Route::get('/me', 'dashboardController@profile')->name('backend.me');
		Route::any('/me/update-password', 'userController@updatePassword')->name('backend.updatePassword');
		
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

		Route::post('/media/uploader/portofolio', 'mediaController@uploadImagePortofolio')->name('backend.media.upload.portofolio');
		Route::post('/media/uploader/webcore', 'mediaController@uploadImageWebcore')->name('backend.media.upload.webcore');
	});
});