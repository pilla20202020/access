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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/birthday', [App\Http\Controllers\HomeController::class, 'birthdayNotification'])->name('birthday');

Route::group(['as' => 'user.','namespace' => 'App\Http\Controllers', 'prefix' => 'user',], function () {
    Route::get('forget-password', 'User\UserController@forgetPassword')->name('forgetPassword');
    Route::post('update-password', 'User\UserController@updatePassword')->name('updatePassword');

});

Route::group(['middleware' => 'auth','namespace' => 'App\Http\Controllers'], function () {
    Route::get('/dashboard','Dashboard\DashboardController@index')->name('dashboard');


    Route::get('setting', 'Setting\SettingController@index')->name('setting.index');
    Route::put('setting/update', 'Setting\SettingController@update')->name('setting.update');


    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function (){
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    /*
    |--------------------------------------------------------------------------
    | User CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'user.', 'prefix' => 'user',], function () {
        Route::get('', 'User\UserController@index')->name('index')->middleware('permission:user-index');
        Route::get('user-data', 'User\UserController@getAllData')->name('data')->middleware('permission:user-data');
        Route::get('create', 'User\UserController@create')->name('create')->middleware('permission:user-create');
        Route::post('', 'User\UserController@store')->name('store')->middleware('permission:user-store');
        Route::get('{user}/edit', 'User\UserController@edit')->name('edit')->middleware('permission:user-edit');
        Route::put('{user}', 'User\UserController@update')->name('update')->middleware('permission:user-update');
        Route::get('user/{id}/destroy', 'User\UserController@destroy')->name('destroy')->middleware('permission:user-delete');
        Route::get('update-profile', 'User\UserController@profileUpdate')->name('profileUpdate');
        Route::post('update-profile/{id}', 'User\UserController@profileUpdateStore')->name('updateProfile');

    });

    /*
    |--------------------------------------------------------------------------
    | Role CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'role.', 'prefix' => 'role',], function () {
        Route::get('', 'Role\RoleController@index')->name('index')->middleware('permission:role-index');
        Route::get('role-data', 'Role\RoleController@getAllData')->name('data')->middleware('permission:role-data');
        Route::get('create', 'Role\RoleController@create')->name('create')->middleware('permission:role-create');
        Route::post('', 'Role\RoleController@store')->name('store')->middleware('permission:role-store');
        Route::get('{role}/edit', 'Role\RoleController@edit')->name('edit')->middleware('permission:role-edit');
        Route::put('{role}', 'Role\RoleController@update')->name('update')->middleware('permission:role-update');
        Route::get('role/{id}/destroy', 'Role\RoleController@destroy')->name('destroy')->middleware('permission:role-delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Permission CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'permission.', 'prefix' => 'permission',], function () {
        Route::get('', 'Permission\PermissionController@index')->name('index')->middleware('permission:role-index');
        Route::get('permission-data', 'Permission\PermissionController@getAllData')->name('data')->middleware('permission:role-data');
        Route::get('create', 'Permission\PermissionController@create')->name('create')->middleware('permission:permission-create');
        Route::post('', 'Permission\PermissionController@store')->name('store')->middleware('permission:role-store');
        Route::get('{permission}/edit', 'Permission\PermissionController@edit')->name('edit')->middleware('permission:permission-edit');
        Route::put('{permission}', 'Permission\PermissionController@update')->name('update')->middleware('permission:role-update');
        Route::get('permission/{id}/destroy', 'Permission\PermissionController@destroy')->name('destroy')->middleware('permission:permission-delete');
    });


    Route::group(['as'=>'common.', 'prefix'=>'common'], function(){
        Route::post('provinces', 'Common\CommonController@getProvincesByCountryId')->name('province.countryId');
        Route::post('districts', 'Common\CommonController@getDistrictsByProvinceId')->name('district.provinceId');
    });

    /*
    |--------------------------------------------------------------------------
    | qualification CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'qualification.', 'prefix' => 'qualification',], function () {
        Route::get('', 'Common\QualificationController@index')->name('index');
        Route::get('qualification-data', 'Common\QualificationController@getAllData')->name('data');
        Route::get('create', 'Common\QualificationController@create')->name('create');
        Route::post('', 'Common\QualificationController@store')->name('store');
        Route::get('{qualification}/edit', 'Common\QualificationController@edit')->name('edit');
        Route::put('{qualification}', 'Common\QualificationController@update')->name('update');
        Route::get('get-qualifications','Common\QualificationController@getQualifications')->name('get_qualifications');
    });

    /*
    |--------------------------------------------------------------------------
    | Preparation CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'preparation.', 'prefix' => 'preparation',], function () {
        Route::get('', 'Common\TestPreparationController@index')->name('index');
        Route::get('preparation-data', 'Common\TestPreparationController@getAllData')->name('data');
        Route::get('create', 'Common\TestPreparationController@create')->name('create');
        Route::post('', 'Common\TestPreparationController@store')->name('store');
        Route::get('{preparation}/edit', 'Common\TestPreparationController@edit')->name('edit');
        Route::put('{preparation}', 'Common\TestPreparationController@update')->name('update');
        Route::get('get-preparation','Common\TestPreparationController@getQualifications')->name('get_qualifications');
        Route::get('preparation/{id}/destroy', 'Common\TestPreparationController@destroy')->name('destroy')->middleware('permission:permission-delete');

    });


    /*
    |--------------------------------------------------------------------------
    | LeadCategory CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'leadcategory.', 'prefix' => 'leadcategory',], function () {
        Route::get('', 'LeadCategory\LeadCategoryController@index')->name('index');
        Route::get('leadcategory-data', 'LeadCategory\LeadCategoryController@getAllData')->name('data');
        Route::get('create', 'LeadCategory\LeadCategoryController@create')->name('create');
        Route::post('', 'LeadCategory\LeadCategoryController@store')->name('store');
        Route::get('{leadcategory}/edit', 'LeadCategory\LeadCategoryController@edit')->name('edit');
        Route::put('{leadcategory}', 'LeadCategory\LeadCategoryController@update')->name('update');
        Route::get('leadcategory/{id}/destroy', 'LeadCategory\LeadCategoryController@destroy')->name('destroy')->middleware('permission:permission-delete');

    });


    /*
    |--------------------------------------------------------------------------
    | Location CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'location.', 'prefix' => 'location',], function () {
        Route::get('', 'Location\LocationController@index')->name('index');
        Route::get('location-data', 'Location\LocationController@getAllData')->name('data');
        Route::get('create', 'Location\LocationController@create')->name('create');
        Route::post('', 'Location\LocationController@store')->name('store');
        Route::get('{location}/edit', 'Location\LocationController@edit')->name('edit');
        Route::put('{location}', 'Location\LocationController@update')->name('update');
        Route::get('location/{id}/destroy', 'Location\LocationController@destroy')->name('destroy')->middleware('permission:permission-delete');

    });


    /*
    |--------------------------------------------------------------------------
    | Registration CRUD Routes
    |--------------------------------------------------------------------------
    */


    Route::group(['as' => 'registration.', 'prefix' => 'registration'], function () {
        Route::get('', 'Registration\RegistrationController@index')->name('index');
        Route::get('{blog}/show', 'Registration\RegistrationController@show')->name('show');
        Route::get('/update', 'Registration\RegistrationController@update')->name('update');
        Route::get('registration/{id}/destroy', 'Registration\RegistrationController@destroy')->name('destroy');
        Route::post('addfollowup', 'Registration\RegistrationController@addFollowUp')->name('addfollowup');
        Route::get('/viewfollowup', 'Registration\RegistrationController@viewFollowUp')->name('viewfollowup');
        Route::post('/sendsms', 'Registration\RegistrationController@sendSMS')->name('send_sms');
        Route::post('/updateleadcategory', 'Registration\RegistrationController@updateLeadCategory')->name('update_lead_category');
        Route::get('/getregistration', 'Registration\RegistrationController@getRegistration')->name('getregistration');
        Route::post('/bulkupdate', 'Registration\RegistrationController@bulkUpdate')->name('bulkupdate');
        Route::get('/getregistrationbycampaignandleadcategory/{campaign_id}/{leadcategory_id}', 'Registration\RegistrationController@getRegistrationByCampaignAndFilter')->name('getregistration_by_campaign_and_leadcategory');
        Route::get('/getregistrationbylocationandleadcategory/{location_slug}/{leadcategory_id}', 'Registration\RegistrationController@getRegistrationByLocationAndLeadCategory')->name('getregistration_by_location_and_leadcategory');

    });

    /*
    |--------------------------------------------------------------------------
    | Campaign CRUD Routes
    |--------------------------------------------------------------------------
    */


    Route::group(['as' => 'campaign.', 'prefix' => 'campaign'], function () {
        Route::get('', 'Campaign\CampaignController@index')->name('index');
        Route::get('create', 'Campaign\CampaignController@create')->name('create');
        Route::post('', 'Campaign\CampaignController@store')->name('store');
        Route::put('{campaign}', 'Campaign\CampaignController@update')->name('update');
        Route::get('{campaign}/edit', 'Campaign\CampaignController@edit')->name('edit');
        Route::get('{id}', 'Campaign\CampaignController@destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | FollowUp CRUD Routes
    |--------------------------------------------------------------------------
    */


    Route::group(['as' => 'followup.', 'prefix' => 'followup'], function () {
        Route::get('', 'FollowUp\FollowUpController@index')->name('index');
        Route::get('{blog}/show', 'FollowUp\FollowUpController@show')->name('show');
        Route::get('{id}', 'FollowUp\FollowUpController@destroy')->name('destroy');
    });


});

Route::get('', 'App\Http\Controllers\Frontend\FrontendController@homepage')->name('homepage');


Route::get('customerform', 'App\Http\Controllers\Frontend\FrontendController@homepage')->name('customerform');
Route::get('customerform/store/{headers}/{user_agent}/', 'App\Http\Controllers\Frontend\FrontendController@store')->name('customerform.store');

Route::get('{url}', 'App\Http\Controllers\Frontend\FrontendController@formByURL')->name('formbyurl');

