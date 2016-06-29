<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/admin/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);
Route::get('/admin/change_password', ['as' => 'get.change_password', 'uses' => 'AdminController@getChangePassword']);
Route::get('/admin/users', ['as' => 'get.users', 'uses' => 'AdminController@getUsersList']);
Route::get('/admin/new_user', ['as' => 'get.new_user', 'uses' => 'AdminController@getNewUser']);
Route::get('/admin/edit_user/{id}', ['as' => 'get.edit_user', 'uses' => 'AdminController@getEditUser']);
Route::get('/admin/delete_user/{id}', ['as' => 'get.delete_user', 'uses' => 'AdminController@getDeleteUser']);
Route::get('/admin/clearance', ['as' => 'get.clearance', 'uses' => 'AdminController@getClearanceList']);
Route::get('/admin/new_pin_slip', ['as' => 'get.new_pin_slip', 'uses' => 'AdminController@getNewPinSlip']);
Route::get('/admin/delete_pin_slip/{id}', ['as' => 'get.delete_pin_slip', 'uses' => 'AdminController@getDeletePinSlip']);
Route::get('/admin/clearance_slip/{id}', ['as' => 'get.clearance_slip', 'uses' => 'AdminController@getClearancePinSlip']);
Route::get('/admin/export_csv', ['as' => 'get.export_csv', 'uses' => 'AdminController@getExportCsv']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);


Route::post('/authenticate', ['as' => 'post.auth', 'uses' => 'HomeController@authenticate']);
Route::post('/admin/change_password', ['as' => 'post.change_password', 'uses' => 'AdminController@postChangePassword']);
Route::post('/admin/new_user', ['as' => 'post.new_user', 'uses' => 'AdminController@postNewUser']);
Route::post('/admin/edit_user', ['as' => 'post.edit_user', 'uses' => 'AdminController@postEditUser']);
Route::post('/admin/new_pin_slip', ['as' => 'post.new_pin_slip', 'uses' => 'AdminController@postNewPinSlip']);