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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route Department
Route::group(['prefix' => 'departments'],function(){
    Route::get('','DepartmentControllers@index')->name('depart.index');
    Route::get('/index','DepartmentControllers@indexData')->name('depart.indexData');
    Route::get('/create','DepartmentControllers@create')->name('depart.create');
    Route::get('/{id}/edit','DepartmentControllers@edit')->name('depart.edit');
    Route::post('/store','DepartmentControllers@store')->name('depart.store');
    Route::put('/{id}/update','DepartmentControllers@update')->name('depart.update');
    Route::delete('/{id}/delete','DepartmentControllers@delete')->name('depart.delete');

});

// Route Employee
Route::group(['prefix'=> 'employee'],function(){
    Route::get('','EmployeeController@index')->name('emp.index');
    Route::get('/index','EmployeeController@indexData')->name('emp.indexData');
    Route::get('/create','EmployeeController@create')->name('emp.create');
    Route::get('/{id}/edit','EmployeeController@edit')->name('emp.edit');
    Route::post('/store','EmployeeController@store')->name('emp.store');
    Route::delete('/{id}/delete','EmployeeController@delete')->name('emp.delete');
});
