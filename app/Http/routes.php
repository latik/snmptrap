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

Route::get('/', function () {
    return view('home');
});

Route::get('/status/district/{district_id}', function ($district_id) {
    return App\Point::where('district_id', $district_id)
        ->orderBy('updated_at', 'desc')
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
