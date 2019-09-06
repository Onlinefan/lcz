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
Route::match(['get', 'post'], '/accounts', 'AccountController@index')->name('accounts');
Route::get('/summary', 'SummaryController@index')->name('summary');
Route::get('/statuses', 'StatusController@index')->name('statuses');
Route::get('/contracts', 'ContractController@index')->name('contracts');
Route::get('/contacts', 'ContactController@index')->name('contacts');
Route::get('/production_plan', 'ProductionPlanController@index')->name('production_plan');
Route::get('/openings', 'OpeningController@index')->name('openings');
Route::get('/home2', 'Home2Controller@index')->name('home2');
Route::get('/progress', 'ProgressController@index')->name('progress');
Route::get('/edit-project', 'ProjectController@create')->name('edit-project');
Route::get('/funds', 'FundController@index')->name('funds');
Route::get('/letters', 'LetterController@index')->name('letters');
Route::post('/add_letter', 'LetterController@create')->name('add_letter');
Route::resource('/regions', 'RegionController');
Route::match(['get', 'post'], '/account_edit/{id}', 'AccountController@edit')->name('account_edit');
Route::match(['get', 'post'], '/add_production_plan', 'ProductionPlanController@createView')->name('add_production_plan');
Route::match(['get', 'post'], '/add_production_plan_to_table', 'ProductionPlanController@create')->name('add_production_plan');
Route::match(['get', 'post'], '/add-project', 'ProjectController@add')->name('add-project');
