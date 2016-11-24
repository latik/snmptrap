<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDashboardPointPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_point', function (Blueprint $table) {
            $table->integer('dashboard_id')->unsigned()->index();
            $table->foreign('dashboard_id')->references('id')->on('dashboard')->onDelete('cascade');
            $table->integer('point_id')->unsigned()->index();
            $table->foreign('point_id')->references('id')->on('point')->onDelete('cascade');
            $table->primary(['dashboard_id', 'point_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dashboard_point');
    }
}
