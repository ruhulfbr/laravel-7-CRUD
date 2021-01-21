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

Route::get('/', 'Contacts@index');
Route::post('/contact/store', 'Contacts@Store')->name('contact/store');
Route::get('/contact/edit/{id}', 'Contacts@Edit')->name('contact/edit');
Route::post('/contact/update', 'Contacts@Update')->name('contact/update');
Route::get('/contact/delete/{id}', 'Contacts@Delete')->name('contact/delete');
