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

Route::domain('{company_name}.benndip.me')->group(function () {
    Route::get('welcome', 'TenantController@index');
});

Route::post('create_new_tenants', 'TenantController@store');
Route::get('tenants', 'TenantController@index');
Route::get('tenants', 'TenantController@index');
