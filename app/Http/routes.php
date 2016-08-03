<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Dashboard;

Route::get('/', function () {
    return view('home', [
        'dashboards' => \App\Dashboard::all(),
        'active' => 1,
    ]);
});

Route::get('/status/dashboard/{dashboard}', function (Dashboard $dashboard) {
    return App\Point::whereRaw($dashboard->getAttribute('sql'))
        ->orderByRaw('status desc, updated_at desc')
        ->limit(50)
        ->get();
});


Route::group(['middleware' => ['web']], function () {
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
});


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['api']], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::resource('point', 'PointRestController');
    });
});
