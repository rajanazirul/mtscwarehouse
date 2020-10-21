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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

    Route::resources([
        'users' => 'UserController',
        'inventory/products' => 'ProductController',
        'inventory/categories' => 'ProductCategoryController',
        'customers' => 'CustomerController',
        'dmform/onsites' => 'OnsiteController',
        'dmform' => 'DmformController',
        'purposes' => 'PurposeController',
       
      
    ]);

    Route::resource('dmform', 'DmformController')->except(['edit', 'update']);
    Route::get('dmform/{dmform}/finalize', ['as' => 'dmform.finalize', 'uses' => 'DmformController@finalize']);
    Route::get('dmform/{dmform}/product/add', ['as' => 'dmform.product.add', 'uses' => 'DmformController@addproduct']);
    Route::get('dmform/{dmform}/product/{takenproduct}/edit', ['as' => 'dmform.product.edit', 'uses' => 'DmformController@editproduct']);
    Route::post('dmform/{dmform}/product', ['as' => 'dmform.product.store', 'uses' => 'DmformController@storeproduct']);
    Route::match(['put', 'patch'], 'dmform/{dmform}/product/{takenproduct}', ['as' => 'dmform.product.update', 'uses' => 'DmformController@updateproduct']);
    Route::delete('dmform/{dmform}/product/{takenproduct}', ['as' => 'dmform.product.destroy', 'uses' => 'DmformController@destroyproduct']);
    
    Route::resource('onsites', 'OnsiteController')->except(['edit', 'update']);
    Route::get('onsites/{onsite}/finalize', ['as' => 'onsites.finalize', 'uses' => 'OnsiteController@finalize']);
    Route::get('onsites/{onsite}/product/add', ['as' => 'onsites.product.add', 'uses' => 'OnsiteController@addproduct']);
    Route::get('onsites/{onsite}/product/{takenproduct}/edit', ['as' => 'onsites.product.edit', 'uses' => 'OnsiteController@editproduct']);
    Route::post('onsites/{onsite}/product', ['as' => 'onsites.product.store', 'uses' => 'OnsiteController@storeproduct']);
    Route::delete('onsites/{onsite}/product/{takenproduct}', ['as' => 'onsites.product.destroy', 'uses' => 'OnsiteController@destroyproduct']);


    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::match(['put', 'patch'], 'profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::match(['put', 'patch'], 'profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
    Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
    Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
});
