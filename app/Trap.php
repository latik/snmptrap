<?php

namespace App;

/**
 * Class Trap
 * @package App
 */
class Trap
{
    const IP_SNMP_PATTERN = '#SNMP-COMMUNITY-MIB::snmpTrapAddress.0 (\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})#iu';

    const IP_UDP_PATTERN = '#\[(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})\]:(\d+)->#iu';

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
     * Trap constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->ip = $this->getIpAddress($input);
        $this->port = $this->getPort($input);
        $this->status = $this->getStatus($input);

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

        if (preg_match(self::IP_SNMP_PATTERN, $input, $match)) {
            $ip = $match[1];
        } elseif (preg_match(self::IP_UDP_PATTERN, $input, $match)) {
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

    /**
     * Extract port
     * @param $input
     * @return string $status
     */
    protected function getStatus($input)
    {
        $status = '';
        if (preg_match('#IF-MIB::ifOperStatus.(\d+) (\w+)#iu', $input, $match)) {
            $status = (string)trim($match[2]);
        }
        return $status;
    }

    /**
     * @todo not working yet
     * @param $input
     * @return static
     */
    public static function createFromInput($input)
    {
        return new static($input);
    }
}
