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
// Root
Route::get('/', function() {
    return redirect('/home');
});

//Home
Route::get('/home', 'HomeController@show')->name('home');


//Auctions
Route::get('my-auctions', 'AuctionController@list')->name('my_auctions');
Route::get('auctions', 'AuctionController@all')->name('auctions');
Route::get('auction/{id}', 'AuctionController@show')->name('detail');
Route::get('auctions/create', 'AuctionController@showAuctionForm')->name('create_auction');
Route::post('auctions/create', 'AuctionController@create')->name('create-auction');
Route::post('auction/approve/{id}', 'AuctionController@approve')->name('approve');

//Reports
Route::post('auction/solve', 'AuctionReportController@markAsSolved')->name('solved');

//Bids
Route::put('auction/{id}/bid', 'BidController@create')->name('bid');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// User
Route::get('user/{id}', 'UserController@show')->name('user_profile');
Route::get('users', 'UserController@list')->name('user_list');

//Admin
Route::get('admin', 'UserController@adminDashboard')->name('admin_dashboard');

//Notifications
Route::get('user/{id}/notifications', 'UserController@notifications')->name('notifications');

//Default
Route::get('/default', 'DefaultController@show')->name('default');
