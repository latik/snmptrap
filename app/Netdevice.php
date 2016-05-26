<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Netdevice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'netdevices';

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
    protected $fillable = ['city', 'new_district', 'street_name', 'house_name', 'doorway', 'house_id', 'ip', 'mac', 'dev_name', 'sw_role', 'vendor_model', 'inventary_state', 'community', 'vlan', 'mon_type', 'port_number', 'parent_mac', 'parent_port', 'abon_current', 's_level'];
}