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

Route::auth();

Route::get('logout', function () {
    Auth::logout();
    Session::flush();

    return Redirect::to(preg_replace("/:\/\//", '://log:out@', url('/')));
});

Route::group(['middleware' => ['auth.basic']], function () {
    Route::resource('user', 'UserController');
    Route::resource('logs', 'LogsController');
    Route::resource('point', 'PointController');
    Route::resource('netdevice', 'NetdeviceController');
    Route::resource('dashboard', 'DashboardController');

    Route::get('import', function () {
        return view('netdevice.import');
    })->name('netdevice.import');

    Route::post('import', 'NetdeviceController@import');

    Route::get('/', function () {
        return view('home', [
            'dashboards' => \App\Dashboard::all(),
            'active'     => 1,
        ]);
    });

    Route::get('/status/dashboard/{dashboard}', function (\App\Dashboard $dashboard) {
        return App\Point::whereRaw($dashboard->getAttribute('sql'))
            ->orderBy('updated_at', 'desc')
            ->limit(50)
            ->get();
    });
});
