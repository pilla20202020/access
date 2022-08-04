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

Route::get('/', function () {
    return route('customerform');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');



Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {



    Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard'], function () {
        Route::get('', 'Backend\DashboardController@index')->name('index');
    });



    /*
        |--------------------------------------------------------------------------
        | Registration CRUD Routes
        |--------------------------------------------------------------------------
        */


    Route::group(['as' => 'registration.', 'prefix' => 'registration'], function () {
        Route::get('', 'Backend\RegistrationController@index')->name('index');
        Route::get('{blog}/show', 'Backend\RegistrationController@show')->name('show');
        Route::get('{id}', 'Backend\RegistrationController@destroy')->name('destroy');
    });

    /*
        |--------------------------------------------------------------------------
        | Campaign CRUD Routes
        |--------------------------------------------------------------------------
        */


        Route::group(['as' => 'campaign.', 'prefix' => 'campaign'], function () {
            Route::get('', 'Backend\CampaignController@index')->name('index');
            Route::get('create', 'Backend\CampaignController@create')->name('create');
            Route::post('', 'Backend\CampaignController@store')->name('store');
            Route::put('{campaign}', 'Backend\CampaignController@update')->name('update');
            Route::get('{campaign}/edit', 'Backend\CampaignController@edit')->name('edit');
            Route::get('{id}', 'Backend\CampaignController@destroy')->name('destroy');

        });


});

Route::get('', 'Frontend\FrontendController@homepage')->name('homepage');


Route::get('customerform', 'Backend\CustomerController@customerForm')->name('customerform');
Route::post('customerform/store', 'Backend\CustomerController@store')->name('customerform.store');




