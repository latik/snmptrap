<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a given Closure or controller and enjoy the fresh air.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/status/district/{district_id}', function ($district_id) {
    return App\Point::where('district_id', $district_id)
        ->orderBy('updated_at', 'desc')
        ->get();
});

Route::auth();

Route::group(['middleware' => ['auth']], function () {

    Route::resource('point', 'PointController');

    Route::resource('netdevice', 'NetdeviceController');

    Route::resource('dashboard', 'DashboardController');

    Route::get('import', function () {
        return view('netdevice.import');
    })->name('netdevice.import');

    Route::post('import', 'NetdeviceController@import');
});
