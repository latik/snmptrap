<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNetdevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netdevices', function(Blueprint $table) {
            $table->increments('id');
            $table->string('city')->default('Zaporozhje');
            $table->string('new_district')->nullable();
            $table->string('street_name')->nullable();
            $table->string('house_name')->nullable();
            $table->string('doorway')->nullable();
            $table->string('house_id')->nullable();
            $table->ipAddress('ip');
            $table->string('mac')->unique();
            $table->string('dev_name')->nullable();
            $table->string('sw_role')->nullable();
            $table->string('vendor_model')->nullable();
            $table->string('inventary_state')->nullable();
            $table->string('community')->nullable();
            $table->integer('vlan')->default(1);
            $table->string('mon_type')->nullable();
            $table->integer('port_number')->nullable();
            $table->string('parent_mac')->nullable();
            $table->integer('parent_port')->nullable();
            $table->integer('abon_current')->nullable();
            $table->string('s_level')->nullable();
            $table->timestamps();
            $table->foreign('parent_mac')->references('mac')->on('netdevices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('netdevices');
    }
}
