<?php

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

/*
Route::get('/', 'HomeController@welcome');

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('/', 'HomeController@welcome');

    Auth::routes();
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::get('/category/category_id/{category_id?}', '\App\Http\Controllers\CategoryController@listAuctionsFromCategory')->name('category');

    Route::get('/category/{seo_url_path}/{page?}', '\App\Http\Controllers\CategoryController@listAuctionsFromCategorySlug')->name('category_seo_url_path');

    Route::get('/search/{term?}/{page?}', '\App\Http\Controllers\SearchController@searchAuctions')->name('search_auctions');

    Route::get('/auction/details/{auction_id}', '\App\Http\Controllers\AuctionController@details')->name('auction_details');

    Route::get('/auction/biddings/{auction_id}', '\App\Http\Controllers\AuctionController@biddings')->name('auction_biddings');

    //Route::post('/auction/bid', '\App\Http\Controllers\AuctionController@bid')->name('auction_bid');

    Route::get('/user/details/{user_id}', '\App\Http\Controllers\UserController@details')->name('user_details');

    Route::get('/user/list-auctions/user_id/{user_id}/{page?}', '\App\Http\Controllers\UserController@listAuctionsFromUser')->name('list_auctions_from_user');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/test', 'HomeController@test')->name('test');

    Route::group(['middleware' => 'auth'], function () {
        Route::post('/auction/bid', '\App\Http\Controllers\AuctionController@bid')->name('auction_bid');

        Route::get('/setup-auction', '\App\Http\Controllers\ProtectedRoutes\AuctionsController@setupAuction')->name('setup_auction');

        Route::get('/profile', '\App\Http\Controllers\ProtectedRoutes\ProfileController@profile')->name('profile');

        Route::get('/selling/my-auctions', '\App\Http\Controllers\ProtectedRoutes\SellingController@myAuctions')->name('selling__my_auctions');
    });

});
