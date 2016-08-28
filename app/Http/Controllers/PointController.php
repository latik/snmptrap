<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;
use Session;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $point = Point::orderBy('updated_at', 'desc')->paginate(10);

        return $this->view->make('point.index', compact('point'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return $this->view->make('point.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ip' => 'required|ip',
            'port' => "required|integer|unique:points,port,null,ip,ip,{$request->input('ip')}",
        ]);

        Point::create($request->all());

        Session::flash('flash_message', 'Point added!');

        return redirect('point');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $point = Point::findOrFail($id);

        return $this->view->make('point.show', compact('point'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $point = Point::findOrFail($id);

        return $this->view->make('point.edit', compact('point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'ip' => 'required|ip',
            'port' => "unique:points,port,{$id},id,ip,{$request->input('ip')}",
        ]);

        $point = Point::findOrFail($id);
        $point->update($request->all());

        Session::flash('flash_message', 'Point updated!');

        return redirect('point');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Point::destroy($id);

        Session::flash('flash_message', 'Point deleted!');

        return redirect('point');
    }
}
