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
Route::get('/', function () {
    return redirect('/home');
});

//Home
Route::get('/home', 'HomeController@show')->name('home');
Route::get('/faq', 'HomeController@showFAQ')->name('faq');
Route::get('/about', 'HomeController@showAbout')->name('about');

//Comments
Route::get('auction/{id}/comments/{parent?}', 'CommentController@showCommentForm')->name('create_comment');
Route::post('auction/comments/', 'CommentController@createComment')->name('create-comment');


//Auctions
Route::get('my-auctions', 'AuctionController@list')->name('my_auctions');
Route::get('auctions', 'AuctionController@all')->name('auctions');
Route::get('auction/{id}', 'AuctionController@show')->name('detail');
Route::get('auctions/create', 'AuctionController@showAuctionForm')->name('create_auction');
Route::post('auctions/create', 'AuctionController@create')->name('create-auction');
Route::post('auction/approve/{id}', 'AuctionController@approve')->name('approve');
Route::post('auction/deny/{id}', 'AuctionController@deny')->name('deny');
Route::post('auction/abort/{id}', 'AuctionController@abort')->name('abort');
Route::post('auction/cancel/{id}', 'AuctionController@cancel')->name('cancel');


//Reports
Route::post('auction/solve', 'AuctionReportController@markAsSolved')->name('solved');

//Bids
Route::put('auction/{id}/bid', 'BidController@create')->name('bid');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// User
Route::get('user/editProfile', 'UserController@showEditForm')->name('user_edit');
Route::post('user/editProfile', 'UserController@edit')->name('user-edit');
Route::get('user/{id}', 'UserController@show')->name('user_profile');
Route::get('users', 'UserController@list')->name('user_list');
Route::get('{id}/requests', 'UserController@requests')->name('requests');


//Admin
Route::get('admin', 'UserController@adminDashboard')->name('admin_dashboard');

//Notifications
Route::get('user/{id}/notifications', 'UserController@notifications')->name('notifications');
Route::get('readnotification/{id}', 'UserController@readNotification')->name('readnotification');

//Default
Route::get('/default', 'DefaultController@show')->name('default');

//Credits
Route::get('transaction', 'TransactionController@showTransactionForm')->name('create_transaction');
Route::post('transaction/create', 'TransactionController@create')->name('create-transaction');
Route::post('transaction/approve/{id}', 'TransactionController@approve')->name('approve-transaction');
Route::post('transaction/deny/{id}', 'TransactionController@deny')->name('deny-transaction');

//Images
Route::get('image', 'ImageController@form')->name('upload_image');
Route::post('image/upload', 'ImageController@upload')->name('upload-image');


//Search
Route::post('auctions/search', 'SearchController@searchAuction')->name('search-auction');

