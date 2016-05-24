<?php

namespace App\Console\Requests;

/**
 * Class Trap
 * @package App\Console\Requests
 */
class Trap
{

    /**
     * @var null
     */
    public $ip = null;
    /**
     * @var int
     */
    public $port = 0;
    /**
     * @var string
     */
    public $input = '';

    /**
     * @todo not working yet
     * @param $input
     * @return static
     */
    public static function createFromInput($input)
    {
        return new static($input);
    }

    /**
     * Trap constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->ip = $this->getIpAddress($input);
        $this->port = $this->getPort($input);

        $this->input = $input;
    }

    /**
     * Extract ip from input
     * @param $input
     * @return null
     */
    protected function getIpAddress($input)
    {
        $ip = null;
        if (preg_match('#SNMP-COMMUNITY-MIB::snmpTrapAddress.0 (\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})#iu', $input,
            $match)) {
            $ip = $match[1];
        } elseif (preg_match('#\[(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})\]:161->#iu', $input,
            $match)) {
            $ip = $match[1];
        }

        return $ip;
    }

    /**
     * Extract port
     * @param $input
     * @return int
     */
    protected function getPort($input)
    {
        $port = 0;
        if (preg_match('#IF-MIB::ifOperStatus.(\d+)#iu', $input, $match)) {
            $port = (int)$match[1];
        }
        return $port;
    }
}