<?php

namespace App;

/**
 * Class Trap.
 */
class Trap
{
    const REGEX_IP_SNMP = '#SNMP-COMMUNITY-MIB::snmpTrapAddress.0 (\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})#iu';
    const REGEX_IP_UDP = '#\[(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})\]:(\d+)->#iu';
    const REGEX_OID = '#SNMPv2-MIB::snmpTrapOID.(\d+) ([^\s]+)#iu';
    const REGEX_PORT = '#IF-MIB::ifOperStatus.(\d+)#iu';
    const REGEX_STATUS = '#IF-MIB::ifOperStatus.(\d+) (\w+)#iu';

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
     * @var string
     */
    public $oid = '';

    /**
     * Trap constructor.
     *
     * @param $input
     */
    public function __construct($input)
    {
        $this->ip = $this->getIpAddress($input);
        $this->oid = $this->getOID($input);
        $this->port = $this->getPort($input);
        $this->status = $this->getStatus($input);

        $this->input = $input;
    }

    /**
     * Extract ip from input.
     *
     * @param $input
     *
     * @return null
     */
    protected function getIpAddress($input)
    {
        $ip = $this->extractParam($input, self::REGEX_IP_SNMP, 1);

        if ($ip == null) {
            $ip = $this->extractParam($input, self::REGEX_IP_UDP, 1);
        }

        return $ip;
    }

    /**
     * Extract port.
     *
     * @param $input
     *
     * @return string $status
     */
    protected function getOID($input)
    {
        return $this->extractParam($input, self::REGEX_OID, 2);
    }

    /**
     * Extract port.
     *
     * @param $input
     *
     * @return int
     */
    protected function getPort($input)
    {
        return $this->extractParam($input, self::REGEX_PORT, 1);
    }

    /**
     * Extract status.
     *
     * @param $input
     *
     * @return string $status
     */
    protected function getStatus($input)
    {
        return $this->extractParam($input, self::REGEX_STATUS, 2);
    }

    /**
     * @param $input
     *
     * @return static
     */
    public static function createFromInput($input)
    {
        return new static($input);
    }

    /**
     * Extract param value from string.
     *
     * @param $input
     * @param $regex
     * @param $offset
     *
     * @internal param $match
     *
     * @return null|mixed
     */
    protected function extractParam($input, $regex, $offset)
    {
        $value = null;
        if (preg_match($regex, $input, $match)) {
            if (isset($match[$offset])) {
                return $match[$offset];
            }
        }

        return $value;
    }
}
