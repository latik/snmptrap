<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dashboard = Dashboard::paginate(15);

        return $this->view->make('dashboard.index', compact('dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->view->make('dashboard.create');
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
        $this->validate($request, ['title' => 'required']);

        Dashboard::create($request->all());

        Session::flash('flash_message', 'Dashboard added!');

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $dashboard = Dashboard::findOrFail($id);

        return $this->view->make('dashboard.show', compact('dashboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $dashboard = Dashboard::findOrFail($id);

        return $this->view->make('dashboard.edit', compact('dashboard'));
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
        $this->validate($request, ['title' => 'required']);

        $dashboard = Dashboard::findOrFail($id);
        $dashboard->update($request->all());

        Session::flash('flash_message', 'Dashboard updated!');

        return redirect('dashboard');
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
        Dashboard::destroy($id);

        Session::flash('flash_message', 'Dashboard deleted!');

        return redirect('dashboard');
    }
}
