<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Netdevice;
use App\Point;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class NetdeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $netdevice = Netdevice::paginate(15);

        return view('netdevice.index', compact('netdevice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('netdevice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
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
     * @return void
     */
    public function show($id)
    {
        $netdevice = Netdevice::findOrFail($id);

        return view('netdevice.show', compact('netdevice'));
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
        $netdevice = Netdevice::findOrFail($id);

        return view('netdevice.edit', compact('netdevice'));
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
     * @return void
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
        \DB::table('points')->truncate();

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

            //\Session::flash('success', 'Netswitches uploaded successfully.');

            //\DB::enableQueryLog();

            $netdevices = Netdevice::where('new_district', 'Шевченковский')
                ->where('vendor_model', 'LIKE', '%3510%')->get();

            //dd(\DB::getQueryLog());

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

            return redirect(route('point.index'));
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());

            return redirect(route('netdevice.index'));
        }
    }
}
