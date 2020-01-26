<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTables extends Migration
{
    public function up()
    {
        Schema::table('device_users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('updated_at');
            $table->timestamp('activation_date')->nullable()->after('is_active');
            $table->timestamp('deactivation_date')->nullable()->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('device_users', function (Blueprint $table) {
            $table->dropColumn(['is_active','activation_change_date']);
        });
    }
}
