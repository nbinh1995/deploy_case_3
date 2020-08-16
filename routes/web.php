<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes([
    'register' => true,
    'verify' => true,
    'reset' => true
]);
Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/users', 'AdminController@users')->name('dashboard.users');
    Route::get('/jobs', 'AdminController@jobs')->name('dashboard.jobs');
    Route::get('/companies', 'AdminController@companies')->name('dashboard.companies');
    Route::get('/users_companies', 'AdminController@users_companies')->name('dashboard.users_companies');
    Route::get('/users_candidates', 'AdminController@users_candidates')->name('dashboard.users_candidates');
    Route::patch('/{id}/users_companies', 'AdminController@hot_company')->name('dashboard.users_companies_hot');
    Route::delete('/{id}/users_companies', 'AdminController@destroy_users_companies')->name('dashboard.destroy_users_companies');
    Route::delete('/{id}/users_candidates', 'AdminController@destroy_users_candidates')->name('dashboard.destroy_users_candidates');
    Route::get('/jobs_api', 'AdminController@job_api')->name('dashboard.jobs_api');
    Route::patch('/{id}/jobs_api', 'AdminController@job_api_hot')->name('dashboard.jobs_api_hot');
    Route::get('/companies_noAct', 'AdminController@companies_noAct')->name('dashboard.companies_noAct');
    Route::patch('/{id}/companies_noAct', 'AdminController@active')->name('dashboard.companies_noAct_act');
});

Route::group(['prefix' => 'jobs'], function () {
    Route::get('/', 'HomeController@jobs')->name('jobs.list');
    Route::get('/show/{work}', 'HomeController@showJob')->name('jobs.show');
    Route::post('/store', 'WorkController@store')->name('jobs.store');
    Route::get('/edit/{work}', 'WorkController@edit')->name('jobs.edit');
    Route::patch('/{work}/update', 'WorkController@update')->name('jobs.update');
    Route::delete('/{work}/delete', 'WorkController@destroy')->name('jobs.destroy');
});

Route::group(['prefix' => 'companies'], function () {
    Route::get('/', 'HomeController@companies')->name('companies.list');
    Route::get('/show/{company}', 'HomeController@showCompany')->name('companies.show');
    Route::get('/edit/{company}', 'CompanyController@edit')->name('companies.edit');
    Route::patch('/{company}/update', 'CompanyController@update')->name('companies.update');
    Route::get('/candidates/{company}', 'CompanyController@candidates')->name('companies.candidates');
});

Route::group(['prefix' => 'profiles'], function () {
    Route::get('/{profile}/show', 'ProfileController@show')->name('profiles.show');
    Route::get('/{profile}/edit', 'ProfileController@edit')->name('profiles.edit');
    Route::patch('/{profile}/update', 'ProfileController@update')->name('profiles.update');
    Route::post('/apply', 'ProfileController@apply')->name('profiles.apply');
});
