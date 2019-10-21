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
Route::match(['get', 'post'], '/edit-data/{id}', 'ProgressController@editData')->name('edit-data');
Route::post('/create-data', 'ProgressController@createData')->name('create-data');
Route::match(['get', 'post'], '/edit-initial-data/{id}', 'ProgressController@editInitialData')->name('edit-initial-data');
Route::match(['get', 'post'], '/edit-pir/{id}', 'ProgressController@editPir')->name('edit-pir');
Route::match(['get', 'post'], '/edit-production/{id}', 'ProgressController@editProduction')->name('edit-production');
Route::match(['get', 'post'], '/edit-smr/{id}', 'ProgressController@editSmr')->name('edit-smr');
Route::match(['get', 'post'], '/edit-pnr/{id}', 'ProgressController@editPnr')->name('edit-pnr');
Route::match(['get', 'post'], '/edit-documents/{id}', 'ProgressController@editDocuments')->name('edit-documents');
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
Route::match(['get', 'post'], '/edit-production-plan/{id}', 'ProductionPlanController@edit')->name('edit-production-plan');
Route::post('/edit-production-plan-submit', 'ProductionPlanController@editSubmit')->name('edit-production-plan-submit');
Route::match(['get', 'post'], '/edit-letter/{id}', 'LetterController@edit')->name('edit-letter');
Route::post('/edit-letter-submit', 'LetterController@editSubmit')->name('edit-letter-submit');
Route::match(['get', 'post'], '/add-data-row/{projectId}-{regionId}', 'ProgressController@addRow')->name('add-data-row');
Route::match(['get', 'post'], '/delete-data-row/{id}', 'ProgressController@deleteDataRow')->name('delete-data-row');
Route::match(['get', 'post'], '/products', 'AdminController@products')->name('products');
Route::match(['get', 'post'], '/add-product', 'AdminController@addProduct')->name('add-product');
Route::match(['get', 'post'], '/edit-product/{id}', 'AdminController@editProduct')->name('edit-product');
Route::post('/submit-product/{id}', 'AdminController@submitProduct')->name('submit-product');
Route::post('/create-product', 'AdminController@createProduct')->name('create-product');
Route::match(['get', 'post'], '/delete-product/{id}', 'AdminController@deleteProduct')->name('delete-product');
Route::match(['get', 'post'], '/delete-country/{id}', 'AdminController@deleteCountry')->name('delete-country');
Route::match(['get', 'post'], '/delete-region/{id}', 'AdminController@deleteRegion')->name('delete-region');
Route::match(['get', 'post'], '/add-cost-file', 'FundController@addCostFile')->name('add-cost-file');
Route::post('/create-cost-file', 'FundController@createCostFile')->name('create-cost-file');
Route::match(['get', 'post'], '/po-cafap', 'AdminController@poCafap')->name('po-cafap');
Route::match(['get', 'post'], '/add-po-cafap', 'AdminController@addPoCafap')->name('add-po-cafap');
Route::match(['get', 'post'], '/edit-po-cafap/{id}', 'AdminController@editPoCafap')->name('edit-po-cafap');
Route::post('/submit-po-cafap/{id}', 'AdminController@submitPoCafap')->name('submit-po-cafap');
Route::post('/create-po-cafap', 'AdminController@createPoCafap')->name('create-po-cafap');
Route::match(['get', 'post'], '/delete-po-cafap/{id}', 'AdminController@deletePoCafap')->name('delete-po-cafap');
Route::match(['get', 'post'], '/edit-contact/{id}', 'ContactController@edit')->name('edit-contact');
Route::post('/submit-contact/{id}', 'ContactController@submit')->name('submit-contact');
Route::match(['get', 'post'], '/edit-income-plan/{id}', 'FundController@editIncomePlan')->name('edit-income-plan');
Route::post('/submit-income-plan', 'FundController@submitIncomePlan')->name('submit-income-plan');
Route::get('/delete-income-plan/{id}', 'FundController@deleteIncomePlan')->name('delete-income-plan');
Route::match(['get', 'post'], '/edit-income/{id}', 'FundController@editIncome')->name('edit-income');
Route::post('/submit-income', 'FundController@submitIncome')->name('submit-income');
Route::get('/delete-income/{id}', 'FundController@deleteIncome')->name('delete-income');
Route::match(['get', 'post'], '/edit-cost-plan/{id}', 'FundController@editCostPlan')->name('edit-cost-plan');
Route::post('/submit-cost-plan', 'FundController@submitCostPlan')->name('submit-cost-plan');
Route::get('/delete-cost-plan/{id}', 'FundController@deleteCostPlan')->name('delete-cost-plan');
Route::match(['get', 'post'], '/edit-cost/{id}', 'FundController@editCost')->name('edit-cost');
Route::post('/submit-cost', 'FundController@submitCost')->name('submit-cost');
Route::get('/delete-cost/{id}', 'FundController@deleteCost')->name('delete-cost');
Route::match(['get', 'post'], '/edit-other-document/{id}', 'FundController@editOtherDocument')->name('edit-other-document');
Route::post('/submit-other-document', 'FundController@submitOtherDocument')->name('submit-other-document');
Route::get('/delete-other-document/{id}', 'FundController@deleteOtherDocument')->name('delete-other-document');
Route::get('/moderate', 'WarningController@moderate')->name('moderate');
Route::get('/blocked', 'WarningController@blocked')->name('blocked');
Route::get('/delete-contact/{id}', 'ContactController@delete')->name('delete-contact');
Route::match(['get', 'post'], '/projects-table', 'AdminController@projectsTable')->name('projects-table');
Route::match(['get', 'post'], '/delete-project/{id}', 'AdminController@deleteProject')->name('delete-project');
Route::get('/delete-letter/{id}', 'LetterController@delete')->name('delete-letter');
