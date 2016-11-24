<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Point.
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

    /**
     * @param $status
     *
     * @return void
     */
    public function changeStatus($status)
    {
        if (!empty($status)) {
            $this->setAttribute('status', $status);
            if ($this->isDirty('status')) {
                $this->save();
            }
        }
    }

    /**
     * Get status via netdevice relation.
     *
     * @return string
     */
    public function requestStatus()
    {
        if (null !== $this->netdevice) {
            return $this->netdevice->getPortStatus($this->getAttribute('port'));
        }
    }
}
