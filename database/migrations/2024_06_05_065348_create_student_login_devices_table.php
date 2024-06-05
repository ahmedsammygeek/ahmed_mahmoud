<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_login_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('device_name');
            $table->string('device_platform');
            $table->string('device_serial_number');
            $table->string('device_brand');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_login_devices');
    }
};
