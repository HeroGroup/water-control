<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_alarms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('device_id');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->integer('sensor_index')->length(10)->nullable();
            $table->integer('alarm_id');
            $table->foreign('alarm_id')->references('id')->on('alarms');
            $table->boolean('is_cleared')->default(false);
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
        Schema::dropIfExists('device_alarms');
    }
}
