<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceChangelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_changelogs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('device_id');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->integer('level_meter_send_data_duration')->length(5)->nullable();
            $table->integer('level_meter_gather_data_duration')->length(5)->nullable();
            $table->string('level_meter_micro_switch_position', 20)->nullable();
            $table->integer('alarm_panel_receive_data_duration')->length(5)->nullable();
            $table->integer('alarm_level')->nullable();
            $table->string('alarm_type')->nullable();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('device_changelogs');
    }
}
