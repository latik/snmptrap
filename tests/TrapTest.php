<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TrapTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_trap_from_input()
    {
        $input = '
        UDP: [172.20.7.208]:1043->[172.20.5.3]:162
        DISMAN-EVENT-MIB::sysUpTimeInstance 133:23:08:18.59
        SNMPv2-MIB::snmpTrapOID.0 IF-MIB::linkUp
        IF-MIB::ifIndex.13 13
        IF-MIB::ifAdminStatus.13 up
        IF-MIB::ifOperStatus.13 up
        SNMP-COMMUNITY-MIB::snmpTrapAddress.0 172.20.7.208
        SNMP-COMMUNITY-MIB::snmpTrapCommunity.0 "TJY_R0aX"
        SNMPv2-MIB::snmpTrapEnterprise.0 SNMPv2-SMI::enterprises.259.8.1.11.101
        ';

        $trap = \App\Trap::createFromInput($input);

        $this->assertAttributeEquals('172.20.7.208', 'ip', $trap);
        $this->assertAttributeEquals(13, 'port', $trap);
        $this->assertAttributeEquals('up', 'status', $trap);
    }

    public function test_create_trap_from_input_link_down()
    {
        $input = '
        UDP: [172.20.7.208]:1043->[172.20.5.3]:162
        DISMAN-EVENT-MIB::sysUpTimeInstance 133:23:08:18.59
        SNMPv2-MIB::snmpTrapOID.0 IF-MIB::linkDown
        IF-MIB::ifIndex.13 13
        IF-MIB::ifAdminStatus.13 up
        IF-MIB::ifOperStatus.13 lowerLayerDown
        SNMP-COMMUNITY-MIB::snmpTrapAddress.0 172.20.7.208
        SNMP-COMMUNITY-MIB::snmpTrapCommunity.0 "TJY_R0aX"
        SNMPv2-MIB::snmpTrapEnterprise.0 SNMPv2-SMI::enterprises.259.8.1.11.101
        ';

        $trap = \App\Trap::createFromInput($input);

        $this->assertAttributeNotEquals('up', 'status', $trap);
    }

    public function test_create_trap_from_input_without_udpSource()
    {
        $input = '
        DISMAN-EVENT-MIB::sysUpTimeInstance 133:23:08:18.59
        SNMPv2-MIB::snmpTrapOID.0 IF-MIB::linkUp
        IF-MIB::ifIndex.13 13
        IF-MIB::ifAdminStatus.13 up
        IF-MIB::ifOperStatus.13 up
        SNMP-COMMUNITY-MIB::snmpTrapAddress.0 172.20.7.208
        SNMP-COMMUNITY-MIB::snmpTrapCommunity.0 "TJY_R0aX"
        SNMPv2-MIB::snmpTrapEnterprise.0 SNMPv2-SMI::enterprises.259.8.1.11.101
        ';

        $trap = \App\Trap::createFromInput($input);

        $this->assertAttributeEquals('172.20.7.208', 'ip', $trap);
    }

    public function test_create_trap_from_input_without_snmpTrapAddress()
    {
        $input = '
        UDP: [172.20.7.208]:1043->[172.20.5.3]:162
        DISMAN-EVENT-MIB::sysUpTimeInstance 133:23:08:18.59
        SNMPv2-MIB::snmpTrapOID.0 IF-MIB::linkUp
        IF-MIB::ifIndex.13 13
        IF-MIB::ifAdminStatus.13 up
        IF-MIB::ifOperStatus.13 up
        SNMPv2-MIB::snmpTrapEnterprise.0 SNMPv2-SMI::enterprises.259.8.1.11.101
        ';

        $trap = \App\Trap::createFromInput($input);

        $this->assertAttributeEquals('172.20.7.208', 'ip', $trap);
    }
}
