<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dashboard;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $dashboard = Dashboard::paginate(15);

        return view('dashboard.index', compact('dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required', ]);

        Dashboard::create($request->all());

        Session::flash('flash_message', 'Dashboard added!');

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $dashboard = Dashboard::findOrFail($id);

        return view('dashboard.show', compact('dashboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $dashboard = Dashboard::findOrFail($id);

        return view('dashboard.edit', compact('dashboard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['title' => 'required', ]);

        $dashboard = Dashboard::findOrFail($id);
        $dashboard->update($request->all());

        Session::flash('flash_message', 'Dashboard updated!');

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Dashboard::destroy($id);

        Session::flash('flash_message', 'Dashboard deleted!');

        return redirect('dashboard');
    }
}
