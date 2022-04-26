<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('Admin')->group(function () {
    /**
     * Routes Profiles
     */
    Route::any('/profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');

    /**
     * Routes Plans
     */
    Route::prefix('plans')->name('plans.')->group(function () {
        Route::get('/create', 'PlanController@create')->name('create');
        Route::any('/search', 'PlanController@search')->name('search');
        Route::get('/{url}/edit', 'PlanController@edit')->name('edit');
        Route::get('/{url}', 'PlanController@show')->name('show');
        Route::put('/{url}', 'PlanController@update')->name('update');
        Route::delete('/{url}', 'PlanController@destroy')->name('destroy');
        Route::get('/', 'PlanController@index')->name('index');
        Route::post('/', 'PlanController@store')->name('store');

        /**
         * Routes Plan Details
         */
        Route::prefix('{planUrl}/details')->name('details.')->group(function () {
            Route::get('/create', 'PlanDetailController@create')->name('create');
            Route::get('/{planDetailId}/edit', 'PlanDetailController@edit')->name('edit');
            Route::get('/', 'PlanDetailController@index')->name('index');
            Route::post('/', 'PlanDetailController@store')->name('store');
            Route::get('/{planDetailId}', 'PlanDetailController@show')->name('show');
            Route::put('/{planDetailId}', 'PlanDetailController@update')->name('update');
            Route::delete('/{planDetailId}', 'PlanDetailController@destroy')->name('destroy');
        });
    });

    /**
     * Home Dashboard
     */
    Route::get('/', 'PlanController@index')->name('admin.index');
});

Route::get('/', function () {
    return view('welcome');
});
