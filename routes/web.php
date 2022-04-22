<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::prefix('plans')->name('plans.')->group(function () {
        Route::get('/{url}', 'PlanController@show')->name('show');
        Route::delete('/{url}', 'PlanController@destroy')->name('destroy');
        Route::get('/create', 'PlanController@create')->name('create');
        Route::any('/search', 'PlanController@search')->name('search');
        Route::get('/', 'PlanController@index')->name('index');
        Route::post('/', 'PlanController@store')->name('store');
    });
});

Route::get('/', function () {
    return view('welcome');
});
