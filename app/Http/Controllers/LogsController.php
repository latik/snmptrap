<?php

namespace App\Http\Controllers;

use App\Logs;
use Illuminate\Http\Request;
use Session;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = Logs::orderBy('created_at', 'desc')
            ->paginate(15);

        return $this->view->make('logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view->make('logs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $log = Logs::findOrFail($id);

        return $this->view->make('logs.show', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $log = Logs::findOrFail($id);

        return $this->view->make('logs.edit', compact('log'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Logs::destroy($id);

        Session::flash('flash_message', 'Log deleted!');

        return redirect('logs');
    }
}
