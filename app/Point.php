<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use GrahamCampbell\Flysystem\Facades\Flysystem;

class Point extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'points';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','district_id', 'district', 'street', 'building', 'entrance', 'status', 'ip', 'port'];

    protected static function boot()
    {
        $export_closure = function () {
            $points = static::all()->toJson();

            Storage::disk('public')->put('status.json', $points);

            Flysystem::connection('sftp')->put('status.json', $points);
        };

        parent::boot();

        //static::saved($export_closure);
        //static::deleted($export_closure);
    }

    public function changeStatus($status)
    {
        if ($status !== 'up') {
            $status = 'alarm';
        }
        $this->status = $status;
        $this->save();
    }
}
