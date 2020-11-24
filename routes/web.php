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
        'dmform' => 'DmformController',
        'purposes' => 'PurposeController',
        'dmaddreturns' => 'DmaddreturnController',

      
        
       
      
    ]);

    Route::resource('dmform', 'DmformController')->except(['edit', 'update']);
    Route::get('dmform/{dmform}/finalize', ['as' => 'dmform.finalize', 'uses' => 'DmformController@finalize']);
    Route::get('dmform/{dmform}/product/add', ['as' => 'dmform.product.add', 'uses' => 'DmformController@addproduct']);
    Route::get('dmform/{dmform}/product/{takenproduct}/edit', ['as' => 'dmform.product.edit', 'uses' => 'DmformController@editproduct']);
    Route::get('dmform/{dmform}/customer/{addcustomer}/edit', ['as' => 'dmform.customer.edit', 'uses' => 'DmformController@editcustomer']);
    Route::post('dmform/{dmform}/product', ['as' => 'dmform.product.store', 'uses' => 'DmformController@storeproduct']);
    Route::match(['put', 'patch'], 'dmform/{dmform}/product/{takenproduct}', ['as' => 'dmform.product.update', 'uses' => 'DmformController@updateproduct']);
    Route::match(['put', 'patch'], 'dmform/{dmform}/customer/{addcustomer}', ['as' => 'dmform.customer.update', 'uses' => 'DmformController@updatecustomer']);
    Route::delete('dmform/{dmform}/product/{takenproduct}', ['as' => 'dmform.product.destroy', 'uses' => 'DmformController@destroyproduct']);
    Route::delete('dmform/{dmform}/customer/{addcustomer}', ['as' => 'dmform.customer.destroy', 'uses' => 'DmformController@destroycustomer']);
    Route::get('dmform/{dmform}/customer/add', ['as' => 'dmform.customer.add', 'uses' => 'DmformController@addcustomer']);
    Route::post('dmform/{dmform}/customer', ['as' => 'dmform.customer.store', 'uses' => 'DmformController@storecustomer']);
    
    Route::resource('dmaddreturns', 'DmaddreturnController')->except(['edit', 'update']);
    Route::get('dmaddreturns/{dmaddreturn}/finalize', ['as' => 'dmaddreturns.finalize', 'uses' => 'DmaddreturnController@finalize']);
    Route::get('dmaddreturns/{dmaddreturn}/product/add', ['as' => 'dmaddreturns.product.add', 'uses' => 'DmaddreturnController@addproduct']);
    Route::get('dmaddreturns/{dmaddreturn}/product/{addreturnproduct}/edit', ['as' => 'dmaddreturns.product.edit', 'uses' => 'DmaddreturnController@editproduct']);
    Route::get('dmaddreturns/{dmaddreturn}/customer/{addcustomerar}/edit', ['as' => 'dmaddreturns.customer.edit', 'uses' => 'DmaddreturnController@editcustomerar']);
    Route::post('dmaddreturns/{dmaddreturn}/product', ['as' => 'dmaddreturns.product.store', 'uses' => 'DmaddreturnController@storeproduct']);
    Route::match(['put', 'patch'], 'dmaddreturns/{dmaddreturn}/product/{addreturnproduct}', ['as' => 'dmaddreturns.product.update', 'uses' => 'DmaddreturnController@updateproduct']);
    Route::match(['put', 'patch'], 'dmaddreturns/{dmaddreturn}/customer/{addcustomerar}', ['as' => 'dmaddreturns.customer.update', 'uses' => 'DmaddreturnController@updatecustomerar']);
    Route::delete('dmaddreturns/{dmaddreturn}/product/{addreturnproduct}', ['as' => 'dmaddreturns.product.destroy', 'uses' => 'DmaddreturnController@destroyproduct']);
    Route::delete('dmaddreturns/{dmaddreturn}/customer/{addcustomerar}', ['as' => 'dmaddreturns.customer.destroy', 'uses' => 'DmaddreturnController@destroycustomerar']);
    Route::get('dmaddreturns/{dmaddreturn}/customer/add', ['as' => 'dmaddreturns.customer.add', 'uses' => 'DmaddreturnController@addcustomerar']);
    Route::post('dmaddreturns/{dmaddreturn}/customer', ['as' => 'dmaddreturns.customer.store', 'uses' => 'DmaddreturnController@storecustomerar']);
    

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
