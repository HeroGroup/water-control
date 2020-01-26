<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_number', 20);
            $table->string('owner')->nullable();
            $table->integer('level_meter_send_data_duration')->length(5)->nullable();
            $table->integer('level_meter_gather_data_duration')->length(5)->nullable();
            $table->string('level_meter_micro_switch_position', 20)->nullable();
            $table->integer('alarm_panel_receive_data_duration')->length(5)->nullable();
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
        Schema::dropIfExists('devices');
    }
}
