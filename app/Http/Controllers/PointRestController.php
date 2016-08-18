<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;
use Response;

/**
 * Class PointController
 */

class PointRestController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     *
     */
    public function index(Request $request)
    {
        return Point::all();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ip' => 'required|ip',
            'port' => "required|integer|unique:points,port,null,ip,ip,{$request->input('ip')}",
        ]);

        return Point::create($request->all());
    }

    /**
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return Point::findOrFail($id);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'ip' => 'required|ip',
            'port' => "unique:points,port,{$id},id,ip,{$request->input('ip')}",
        ]);

        $point = Point::findOrFail($id);
        return $point->update($request->all());
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Point::findOrFail($id)->delete();;
    }
}
