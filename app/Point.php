<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

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
        $this->setAttribute('status', $status);

        if ($this->save()) {
            Log::info("point status changed");
        }
    }

    /**
     * Get the netdevice that owns the point.
     */
    public function netdevice()
    {
        return $this->belongsTo(Netdevice::class, 'ip', 'ip');
    }

    /**
     * The points that belong to the dashboard.
     */
    public function dashboards()
    {
        return $this->belongsToMany(Dashboard::class);
    }

    public function refreshStatus()
    {
        Log::debug("try check point status!!");

        if (null !== $this->netdevice) {
            $this->changeStatus($this->netdevice->getPortStatus($this->port));
        }
    }
}
