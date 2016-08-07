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
    protected $fillable = [
        'city',
        'new_district',
        'street_name',
        'house_name',
        'doorway',
        'house_id',
        'ip',
        'mac',
        'dev_name',
        'sw_role',
        'vendor_model',
        'inventary_state',
        'community',
        'vlan',
        'mon_type',
        'port_number',
        'parent_mac',
        'parent_port',
        'abon_current',
        's_level'
    ];

    /**
     * Get the points for the netdevice.
     */
    public function points()
    {
        return $this->hasMany(Point::class, 'ip');
    }

    public function parent()
    {
        return self::where('mac', $this->parent_mac)->first();
    }

    public function getPortStatus(int $port)
    {
        // RFC1213-MIB
        $status_map = [
            1 => 'up',
            2 => 'down',
            3 => 'testing',
        ];

        $status_code = $this->snmp_get('ifOperStatus.' . $port);

        if (isset($status_map[$status_code])) {
            return $status_map[$status_code];
        }
    }

    protected function snmp_get($oid)
    {
        snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
        snmp_set_oid_numeric_print(true);
        return @snmp2_get($this->ip, $this->community, $oid);
    }
}
