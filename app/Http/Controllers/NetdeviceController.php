<?php

namespace App\Http\Controllers;

use App\Netdevice;
use App\Point;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class NetdeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $netdevice = Netdevice::paginate(15);

        return $this->view->make('netdevice.index', compact('netdevice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return $this->view->make('netdevice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ip' => 'ip',
            'mac' => 'required|unique:netdevices,mac',
        ]);

        Netdevice::create($request->all());

        Session::flash('flash_message', 'Netdevice added!');

        return redirect('netdevice');
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
        $netdevice = Netdevice::findOrFail($id);

        return $this->view->make('netdevice.show', compact('netdevice'));
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
        $netdevice = Netdevice::findOrFail($id);

        return $this->view->make('netdevice.edit', compact('netdevice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'ip' => 'ip',
            'mac' => 'required|unique:netdevices,mac,id',
        ]);

        $netdevice = Netdevice::findOrFail($id);
        $netdevice->update($request->all());

        Session::flash('flash_message', 'Netdevice updated!');

        return redirect('netdevice');
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
        Netdevice::destroy($id);

        Session::flash('flash_message', 'Netdevice deleted!');

        return redirect('netdevice');
    }


    public function import(Request $request)
    {
        \DB::table('netdevices')->truncate();

        $this->validate($request, [
            'file' => 'required'
        ]);

        try {
            Excel::load($request->file('file'), function ($reader) {
                foreach ($reader->toArray() as $row) {
                    try {
                        Netdevice::updateOrCreate($row);
                    } catch (\PDOException $e) {
                    }
                }
            }, 'CP1251//IGNORE');

            $netdevices = Netdevice::all();

            foreach ($netdevices as $netdevice) {
                $parent = $netdevice->parent();

                if ($parent) {
                    $point_data = [
                        'district_id' => 1,
                        'name' => $netdevice->dev_name,
                        'district' => $netdevice->new_district,
                        'street' => $netdevice->street_name,
                        'building' => $netdevice->house_name,
                        'entrance' => $netdevice->doorway,
                        'port' => $netdevice->parent_port,
                        'ip' => $parent->ip,
                    ];

                    $point = Point::firstOrCreate($point_data);
                }
            }
            \Session::flash('success', 'Netswitches imported successfully.');

            return redirect(route('point.index'));

        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());

            return redirect(route('netdevice.index'));
        }
    }
}
