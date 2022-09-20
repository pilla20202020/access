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


    /*
    |--------------------------------------------------------------------------
    | Country CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'countries.', 'prefix' => 'country',], function () {
        Route::get('', 'Country\CountryController@index')->name('index');
        Route::get('country-data', 'Country\CountryController@getAllData')->name('data');
        Route::get('change-status','Country\CountryController@changeStatus')->name('change_status');
    });


    /*
    |--------------------------------------------------------------------------
    | State CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'states.', 'prefix' => 'state',], function () {
        Route::get('', 'State\StateController@index')->name('index');
        Route::get('state-data', 'State\StateController@getAllData')->name('data');
        Route::get('create', 'State\StateController@create')->name('create');
        Route::post('', 'State\StateController@store')->name('store');
        Route::get('{state}/edit', 'State\StateController@edit')->name('edit');
        Route::put('{state}', 'State\StateController@update')->name('update');
        Route::get('change-status','State\StateController@changeStatus')->name('change_status');
    });

        /*
    |--------------------------------------------------------------------------
    | District CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'districts.', 'prefix' => 'district',], function () {
        Route::get('', 'District\DistrictController@index')->name('index');
        Route::get('country-data', 'District\DistrictController@getAllData')->name('data');
        Route::get('get-states', 'District\DistrictController@getState')->name('get_states');
        Route::get('create', 'District\DistrictController@create')->name('create');
        Route::post('', 'District\DistrictController@store')->name('store');
        Route::get('{district}/edit', 'District\DistrictController@edit')->name('edit');
        Route::put('{district}', 'District\DistrictController@update')->name('update');
        Route::get('change-status','District\DistrictController@changeStatus')->name('change_status');
    });


    /*
    |--------------------------------------------------------------------------
    | College CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'colleges.', 'prefix' => 'college',], function () {
        Route::get('', 'College\CollegeController@index')->name('index');
        Route::get('college-data', 'College\CollegeController@getAllData')->name('data');
        Route::get('get-state', 'College\CollegeController@getStates')->name('get_states');
        Route::get('create', 'College\CollegeController@create')->name('create');
        Route::post('', 'College\CollegeController@store')->name('store');
        Route::get('{college}/edit', 'College\CollegeController@edit')->name('edit');
        Route::put('{college}', 'College\CollegeController@update')->name('update');
        Route::get('change-status','College\CollegeController@changeStatus')->name('change_status');
    });

    Route::group(['as'=>'common.', 'prefix'=>'common'], function(){
        Route::post('states', 'Common\CommonController@getStatesByCountryId')->name('state.countryId');
        Route::post('colleges', 'Common\CommonController@getCollegesByStateId')->name('college.provinceId');
        Route::post('provinces', 'Common\CommonController@getProvincesByCountryId')->name('province.countryId');
        Route::post('districts', 'Common\CommonController@getDistrictsByProvinceId')->name('district.provinceId');
    });


    /*
    |--------------------------------------------------------------------------
    | Agent CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'agent.', 'prefix' => 'agent',], function () {
        Route::get('', 'Agent\AgentController@index')->name('index');
        Route::get('create', 'Agent\AgentController@create')->name('create');
        Route::post('', 'Agent\AgentController@store')->name('store');
        Route::get('{agent}/edit', 'Agent\AgentController@edit')->name('edit');
        Route::put('{agent}', 'Agent\AgentController@update')->name('update');
        Route::get('agent/{id}/destroy', 'Agent\AgentController@destroy')->name('destroy');

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
        Route::get('/proceedforadmission/{id}', 'Registration\RegistrationController@proceedForAdmission')->name('proceed_for_admission');
        Route::get('/print/{id}', 'Registration\RegistrationController@print')->name('print');

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


    /*
    |--------------------------------------------------------------------------
    | Student CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'student.', 'prefix' => 'student',], function () {
        Route::get('', 'Student\StudentController@index')->name('index');
        Route::get('student-data', 'Student\StudentController@getAllData')->name('data');
        Route::get('create', 'Student\StudentController@create')->name('create');
        Route::post('', 'Student\StudentController@store')->name('store');
        Route::get('{student}/edit', 'Student\StudentController@edit')->name('edit');
        Route::put('{student}', 'Student\StudentController@update')->name('update');
        Route::get('student/{id}/destroy', 'Student\StudentController@destroy')->name('destroy');
        Route::get('/{id}/delete-academic','Student\StudentController@deleteAcademic')->name('delete_academic');
        Route::get('/{id}/delete-test','Student\StudentController@deleteTest')->name('delete_test');


    });


    /*
    |--------------------------------------------------------------------------
    | Program CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'program.', 'prefix' => 'program',], function () {
        Route::get('', 'Program\ProgramController@index')->name('index');
        Route::get('create', 'Program\ProgramController@create')->name('create');
        Route::post('', 'Program\ProgramController@store')->name('store');
        Route::get('{program}/edit', 'Program\ProgramController@edit')->name('edit');
        Route::put('{program}', 'Program\ProgramController@update')->name('update');
        Route::get('program/{id}/destroy', 'Program\ProgramController@destroy')->name('destroy');
        Route::get('/{id}/delete-intake','Program\ProgramController@deleteIntake')->name('delete_intake');
        Route::get('/{id}/delete-fee','Program\ProgramController@deleteFee')->name('delete_fee');
        Route::get('/{id}/delete-eligibility','Program\ProgramController@deleteEligibility')->name('delete_eligibility');
        Route::get('/{id}/delete-criteria','Program\ProgramController@deleteCriteria')->name('delete_criteria');

    });


    /*
    |--------------------------------------------------------------------------
    | Admission CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'admission.', 'prefix' => 'admission',], function () {
        Route::get('', 'Admission\AdmissionController@index')->name('index');
        Route::get('admission-data', 'Admission\AdmissionController@getAllData')->name('data');
        Route::get('create', 'Admission\AdmissionController@create')->name('create');
        Route::post('', 'Admission\AdmissionController@store')->name('store');
        Route::get('{admission}/edit', 'Admission\AdmissionController@edit')->name('edit');
        Route::put('{admission}', 'Admission\AdmissionController@update')->name('update');
        Route::get('admission/{id}/destroy', 'Admission\AdmissionController@destroy')->name('destroy');
        Route::get('addcommencement', 'Admission\AdmissionController@addCommencement')->name('addcommencement');
        Route::get('getcommencementlist', 'Admission\AdmissionController@getCommencedAdmission')->name('getcommencedadmission');

        Route::get('commission-rate/{id}/', 'Admission\AdmissionController@commissionRate')->name('commission');
        Route::post('commission/store','Admission\AdmissionController@storeCommissionRate')->name('store_commission');
        Route::get('/{id}/delete-commission','Admission\AdmissionController@deleteCommission')->name('delete_commission');
        Route::get('getcommissiondetail', 'Admission\AdmissionController@getCommissionDetail')->name('getcommissiondetail');
        Route::post('addcommissionclaim', 'Admission\AdmissionController@addCommissionClaim')->name('addcommissionclaim');
        Route::post('addfollowup', 'Admission\AdmissionController@addFollowUp')->name('addfollowup');
        Route::get('invoice/{id}', 'Admission\AdmissionController@generateInvoice')->name('generateinvoice');

    });

    /*
    |--------------------------------------------------------------------------
    | Commission Claim List
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'commission-claim.', 'prefix' => 'commission-claim',], function () {
        Route::get('', 'CommissionClaim\CommissionClaimController@index')->name('index');
        Route::get('get-commission-by-parameter', 'CommissionClaim\CommissionClaimController@getCommissionByParameter')->name('get_commission_by_parameter');
        Route::get('claimed', 'CommissionClaim\CommissionClaimController@claimed')->name('claimed');
        Route::get('get-claimed-commission-by-parameter', 'CommissionClaim\CommissionClaimController@getClaimedCommissionByParameter')->name('get_claimed_commission_by_parameter');
        Route::get('create', 'CommissionClaim\CommissionClaimController@create')->name('create');
        Route::post('', 'CommissionClaim\CommissionClaimController@store')->name('store');
        Route::get('{commission-claim}/edit', 'CommissionClaim\CommissionClaimController@edit')->name('edit');
        Route::put('{commission-claim}', 'CommissionClaim\CommissionClaimController@update')->name('update');
        Route::get('commission-claim/{id}/destroy', 'CommissionClaim\CommissionClaimController@destroy')->name('destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | DocumentCheck List CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'document_checklist.', 'prefix' => 'document_checklist',], function () {
        Route::get('', 'DocumentChecklist\DocumentChecklistController@index')->name('index');
        Route::get('create', 'DocumentChecklist\DocumentChecklistController@create')->name('create');
        Route::post('', 'DocumentChecklist\DocumentChecklistController@store')->name('store');
        Route::get('{document_checklist}/edit', 'DocumentChecklist\DocumentChecklistController@edit')->name('edit');
        Route::put('{document_checklist}', 'DocumentChecklist\DocumentChecklistController@update')->name('update');
        Route::get('document_checklist/{id}/destroy', 'DocumentChecklist\DocumentChecklistController@destroy')->name('destroy')->middleware('permission:permission-delete');
        Route::get('/{id}/delete-checklistitem','DocumentChecklist\DocumentChecklistController@deleteCheckList')->name('delete_checklist');
        Route::get('{document_checklist}/replicate', 'DocumentChecklist\DocumentChecklistController@replicate')->name('replicate');


    });


});

Route::get('', 'App\Http\Controllers\Frontend\FrontendController@homepage')->name('homepage');


Route::get('customerform', 'App\Http\Controllers\Frontend\FrontendController@homepage')->name('customerform');
Route::get('customerform/store/{headers}/{user_agent}/', 'App\Http\Controllers\Frontend\FrontendController@store')->name('customerform.store');


Route::get('visit', 'App\Http\Controllers\Frontend\FrontendController@visit')->name('visit');
Route::post('visit/store/', 'App\Http\Controllers\Frontend\FrontendController@visitStore')->name('visitform.store');

Route::get('{url}', 'App\Http\Controllers\Frontend\FrontendController@formByURL')->name('formbyurl');

