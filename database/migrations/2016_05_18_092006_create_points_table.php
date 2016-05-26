<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('district_id')->default(0);
            $table->string('district')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('entrance')->nullable();
            $table->string('status')->nullable();
            $table->ipAddress('ip');
            $table->integer('port')->unsigned();
            $table->unique(['ip', 'port']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('points');
    }
}
