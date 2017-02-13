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

Route::get('/signup', [
	'uses'=>'UserController@register',
	'as'=>'user.register'
          ]);

Route::post('/postsignup',[
	'uses'=>'UserController@Postregister',
	'as' =>'user.signup'

	]);

Route::post('/postsignin',[
	'uses'=>'UserController@Postsignin',
	'as' =>'user.signin'

	]);

Route::get('/', [
	'uses'=>'UserController@login',
	'as'=>'user.login'
          ]);




Route::get('/logout' ,[
     'uses'=>'UserController@logout',
     'as' =>'user.logout'
	]);

Route::get('/forget',[
     'uses'=>'UserController@forget',
     'as'  =>'user.forget'
	]);

Route::post('/postForgotPassword',[
     'uses' =>'UserController@postForgotPassword',
     'as'   =>'user.postForgotPassword'
      ]);

Route::get('/resetpassword/{code}',[
	'uses' =>'UserController@resetpassword',
	'as' =>'user.resetpassword'
	]);
Route::post('/changePass', [
	'as' => 'changePass', 
	'uses' => 'UserController@changePassword'
	]);


//Product Controller

Route::get('/product',[
	'uses'=>'ProductController@index',
	'as'=>'product.details'

	]);

Route::get('/create',[
	'uses'=>'ProductController@create',
	'as'=>'product.product'

	]);

Route::post('/store',[
	'uses'=>'ProductController@store',
	'as'=>'product.store'

	]);

Route::post('/update',[
	'uses'=>'ProductController@update',
	'as'=>'product.update'

	]);

Route::get('/delete/{id?}',[
   'uses' =>'ProductController@delete',
    'as'=>'delete'
	]);

Route::get('/edit/{id?}', array('as' => 'edit', 'uses' => 'ProductController@edit'));