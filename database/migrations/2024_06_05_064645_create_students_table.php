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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile');
            $table->string('guardian_mobile');
            $table->integer('grade');
            $table->integer('educational_system_id');
            $table->integer('user_id')->nullable();
            $table->tinyInteger('is_banned')->default(0);
            $table->string('password');
            $table->string('app_language');
            $table->text('firebase_fcm')->nullable();
            $table->text('mobile_serial_number')->nullable();
            $table->string('app_platform');
            $table->text('banning_message')->nullbale();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
