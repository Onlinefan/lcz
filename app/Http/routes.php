<?php
//Route::resource('cars', 'CarController');
Route::get('/projects', 'ProjectController@index')->name('projects');
