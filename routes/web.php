<?php

// use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('add_cart', 'HomeController@add_cart')->name('add_cart');
Route::get('cart','HomeController@cart')->name('cart');
Route::post('place_order','HomeController@place_order')->name('place_order');
Route::get('user_transaction','HomeController@transactions')->name('user_transaction');


Route::match(array('GET','POST'),'/send_message','HomeController@send_message')->name('send_message');
Route::match(array('GET','POST'),'admin/authenticate','AdminController@authenticate')->name('authenticate');


// Admin Route

Route::group(['prefix' => 'admin',], function () {
	Route::get('/', function () {
        return view('admin.login');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });



});




Route::namespace("Admin")->prefix('admin')->group(function(){
	Route::get('/', 'HomeController@index')->name('admin.home');
	Route::namespace('Auth')->group(function(){
		Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
		Route::post('/login', 'LoginController@login');
		Route::post('logout', 'LoginController@logout')->name('admin.logout');

         // Items Management
    Route::get('items', 'AdminController@items')->name('items');
    Route::get('view_item/{id}', 'AdminController@view_item')->name('view_item');
    Route::match(array('GET','POST'),'edit_item/{id}', 'AdminController@edit_item')->name('edit_item');
    Route::match(array('GET','POST'),'add_item', 'AdminController@add_item')->name('add_item');
    Route::get('delete_item/{id}','AdminController@delete_item')->name('delete_item');

    // Customer Management
    Route::get('customers', 'AdminController@customers')->name('customers');
    Route::get('view_customer/{id}', 'AdminController@view_customer')->name('view_customer');

    // Transaction Management
    Route::get('transactions', 'AdminController@transactions')->name('transactions');
    Route::get('view_transaction/{id}', 'AdminController@view_transaction')->name('view_transaction');
	});
});


