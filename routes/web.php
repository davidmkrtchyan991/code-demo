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

Auth::routes();

//Home routes
Route::get('/home', 'HomeController@index')->name('home');

/*------------------Administrator routes-----------------------*/
Route::get('admin/users/clients', 'UserController@clients');

Route::get("profile/create", "ProfileController@create");
Route::get("profile/{id}/edit", "ProfileController@edit");
Route::patch("profile/update/{id}", "ProfileController@update");
Route::patch("profile/register", "ProfileController@register")->name("register");

Route::get("admin/maintenance/createKeywords", "MaintenanceController@createKeywords");
Route::get("admin/maintenance/{id}/editKeywords", "MaintenanceController@editKeywords");
Route::post("admin/maintenance/saveKeywords", "MaintenanceController@saveKeywords");
Route::patch("admin/maintenance/updateKeywords/{id}", "MaintenanceController@updateKeywords");

Route::resource('admin/tariff', 'TariffController');
Route::resource('admin/maintenance', 'MaintenanceController');
Route::resource('admin/users', 'UserController');
Route::resource('orders', 'OrderController');
Route::resource('admin/checklists', 'ChecklistController');

Route::post('admin/users/search', 'UserController@search');
Route::post('admin/users/searchClient', 'UserController@searchClient');

Route::post("orders/findUser", "OrderController@findUser");
Route::post("orders/findOptimizer", "OrderController@findOptimizer");
Route::post("orders/loadMaintenancesByTariff", "OrderController@loadMaintenancesByTariff");
Route::post("orders/search", "OrderController@search");

Route::get("orders/getToAssignChecklist/{id}", "OrderController@getToAssignChecklist");
Route::patch("orders/assignChecklist/{id}", "OrderController@assignChecklist");

Route::get("orders/getToAssignTechManager/{id}", "OrderController@getToAssignTechManager");
Route::patch("orders/assignTechManager/{id}", "OrderController@assignTechManager");

Route::get("orders/getToSetCompleted/{id}", "OrderController@getToSetCompleted");
Route::patch("orders/complete/{id}", "OrderController@complete");

Route::get("orders/getToUpdateChecklistStatus/{id}", "OrderController@getToUpdateChecklistStatus");
Route::patch("orders/updateChecklistStatus/{id}", "OrderController@updateChecklistStatus");

Route::get("orders/getToUpdateClientKeywords/{id}", "OrderController@getToUpdateClientKeywords");
Route::patch("orders/updateClientKeywords/{id}", "OrderController@updateClientKeywords");

Route::get("orders/getToConfirmClientKeywords/{id}", "OrderController@getToConfirmClientKeywords");
Route::patch("orders/confirmClientKeywords/{id}", "OrderController@confirmClientKeywords");

Route::get("orders/getToAddExceptionalChecklist/{id}", "OrderController@getToAddExceptionalChecklist");
Route::patch("orders/addExceptionalChecklist/{id}", "OrderController@addExceptionalChecklist");

Route::get("admin/statistics", "StatisticsController@index");
Route::post("admin/statistics/filter", "StatisticsController@filter");


/*------------------Manager routes-----------------------*/

Route::resource('manager/faq', 'FaqController');
Route::post("manager/faq/findFaqCategory", "FaqController@findFaqCategory");


/*------------------Client routes-----------------------*/
Route::get('/', 'HomeController@index');
Route::get('/faq', 'HomeController@faqAll');
Route::post('/faq/searchFaq', 'HomeController@searchFaq');
Route::get('/faq/{id}', 'HomeController@faqShow');
Route::get('/charts', 'HomeController@charts');

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});
//Clear All cache:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});

/* Getting remote data from all projects and filtering by domain, returns current project */
Route::post('/getapi', 'TopvisorController@getRemoteData');

/* Get data of project by id */
Route::post('/getproject', 'TopvisorController@getRemoteDataById');