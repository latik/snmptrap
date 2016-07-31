<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Point
 * @package App
 */
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
    protected $fillable = ['name', 'district_id', 'district', 'street', 'building', 'entrance', 'status', 'ip', 'port'];

    /**
     * @param $status
     * @return bool
     */
    public function changeStatus($status)
    {
        $this->status = $status;
        Log::info("point status changed");
        return $this->save();
    }

    /**
     * Get the netdevice that owns the point.
     */
    public function netdevice()
    {
        return $this->belongsTo(Netdevice::class, 'ip');
    }

    /**
     * The points that belong to the dashboard.
     */
    public function dashboards()
    {
        return $this->belongsToMany(Dashboard::class);
    }
}
