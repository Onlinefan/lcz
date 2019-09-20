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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/projects', 'ProjectController@index')->name('projects');
Route::get('/accounts', 'AccountController@index')->name('accounts');
Route::get('/summary', 'SummaryController@index')->name('summary');
Route::get('/statuses', 'StatusController@index')->name('statuses');
Route::get('/contracts', 'ContractController@index')->name('contracts');
Route::get('/contacts', 'ContactController@index')->name('contacts');
Route::get('/production_plan', 'ProductionPlanController@index')->name('production_plan');
Route::get('/openings', 'OpeningController@index')->name('openings');
Route::get('/home2', 'Home2Controller@index')->name('home2');
Route::get('/progress/{id}', 'ProgressController@index')->name('progress');
Route::match(['get', 'post'], '/edit-project/{id}', 'ProjectController@edit')->name('edit-project');
Route::post('/edit-project-id', 'ProjectController@editProject')->name('edit-project-id');
Route::get('/create-project', 'ProjectController@create')->name('create-project');
Route::get('/funds', 'FundController@index')->name('funds');
Route::get('/letters', 'LetterController@index')->name('letters');
Route::post('/add_letter', 'LetterController@create')->name('add_letter');
Route::resource('/regions', 'RegionController');
Route::match(['get', 'post'], '/account_edit/{id}', 'AccountController@edit')->name('account_edit');
Route::match(['get', 'post'], '/add_production_plan', 'ProductionPlanController@createView')->name('add_production_plan');
Route::match(['get', 'post'], '/add_production_plan_to_table', 'ProductionPlanController@create')->name('add_production_plan');
Route::match(['get', 'post'], '/add-project', 'ProjectController@add')->name('add-project');
Route::get('/download', 'DownloadController@index')->name('download');
Route::match(['get', 'post'], '/add-income-plan', 'FundController@addIncomePlan')->name('add-income-plan');
Route::post('/create-income-plan', 'FundController@createIncomePlan')->name('create-income-plan');
Route::match(['get', 'post'], '/add-cost-plan', 'FundController@addCostPlan')->name('add-cost-plan');
Route::post('/create-cost-plan', 'FundController@createCostPlan')->name('create-cost-plan');
Route::match(['get', 'post'], '/add-other-document', 'FundController@addOtherContract')->name('add-other-document');
Route::post('/create-other-document', 'FundController@createOtherContract')->name('create-other-document');
Route::match(['get', 'post'], '/add-income', 'FundController@addIncome')->name('add-income');
Route::post('/create-income', 'FundController@createIncome')->name('create-income');
Route::match(['get', 'post'], '/add-cost', 'FundController@addCost')->name('add-cost');
Route::post('/create-cost', 'FundController@createCost')->name('create-cost');
Route::match(['get', 'post'], '/add-document-status', 'ContractController@addDocumentStatus')->name('add-document-status');
Route::post('/create-document-status', 'ContractController@createDocumentStatus')->name('create-document-status');
Route::match(['get', 'post'], '/add-service-status', 'ContractController@addServiceStatus')->name('add-service-status');
Route::post('/create-service-status', 'ContractController@createServiceStatus')->name('create-service-status');
Route::match(['get', 'post'], '/add-financial-status', 'ContractController@addFinancialStatus')->name('add-financial-status');
Route::post('/create-financial-status', 'ContractController@createFinancialStatus')->name('create-financial-status');
Route::post('/send-message', 'MessageController@send')->name('send-message');
Route::match(['get', 'post'], '/edit-data/{projectId}-{regionId}', 'ProgressController@editData')->name('edit-data');
Route::post('/create-data', 'ProgressController@createData')->name('create-data');
Route::match(['get', 'post'], '/edit-initial-data/{projectId}-{regionId}', 'ProgressController@editInitialData')->name('edit-initial-data');
Route::match(['get', 'post'], '/edit-pir/{projectId}-{regionId}', 'ProgressController@editPir')->name('edit-pir');
Route::match(['get', 'post'], '/edit-production/{projectId}-{regionId}', 'ProgressController@editProduction')->name('edit-production');
Route::match(['get', 'post'], '/edit-smr/{projectId}-{regionId}', 'ProgressController@editSmr')->name('edit-smr');
Route::match(['get', 'post'], '/edit-pnr/{projectId}-{regionId}', 'ProgressController@editPnr')->name('edit-pnr');
Route::match(['get', 'post'], '/edit-documents/{projectId}-{regionId}', 'ProgressController@editDocuments')->name('edit-documents');
Route::post('/create-documents', 'ProgressController@createDocuments')->name('create-documents');
Route::get('/change-status/{id}-{status}', 'ProjectController@changeStatus')->name('change-status');
Route::post('/get-map', 'SummaryController@getMap')->name('get-map');
Route::match(['get', 'post'], '/get-month', 'SummaryController@getMonthDynamic')->name('get-month');
Route::match(['get', 'post'], '/admin-page', 'AdminController@index')->name('admin-page');
Route::match(['get', 'post'], '/countries', 'AdminController@countries')->name('countries');
Route::match(['get', 'post'], '/add-country', 'AdminController@addCountry')->name('add-country');
Route::match(['get', 'post'], '/edit-country/{id}', 'AdminController@editCountry')->name('edit-country');
Route::post('/submit-country/{id}', 'AdminController@submitCountry')->name('submit-country');
Route::post('/create-country', 'AdminController@createCountry')->name('create-country');
Route::match(['get', 'post'], '/regions', 'AdminController@regions')->name('regions');
Route::match(['get', 'post'], '/add-region', 'AdminController@addRegion')->name('add-region');
Route::match(['get', 'post'], '/edit-region/{id}', 'AdminController@editRegion')->name('edit-region');
Route::post('/submit-region/{id}', 'AdminController@submitRegion')->name('submit-region');
Route::post('/create-region', 'AdminController@createRegion')->name('create-region');
