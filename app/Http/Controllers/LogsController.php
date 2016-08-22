<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Logs;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $logs = Logs::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('logs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {

        Logs::create($request->all());

        Session::flash('flash_message', 'Log added!');

        return redirect('logs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function show($id)
    {
        $log = Logs::findOrFail($id);

        return view('logs.show', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function edit($id)
    {
        $log = Logs::findOrFail($id);

        return view('logs.edit', compact('log'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {

        $log = Logs::findOrFail($id);
        $log->update($request->all());

        Session::flash('flash_message', 'Log updated!');

        return redirect('logs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Logs::destroy($id);

        Session::flash('flash_message', 'Log deleted!');

        return redirect('logs');
    }
}
