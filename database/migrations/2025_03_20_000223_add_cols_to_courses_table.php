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
        Schema::table('courses', function (Blueprint $table) {
            $table->tinyInteger('force_face_detecting')->nullable();
            $table->tinyInteger('speak_user_phone')->nullable();
            $table->tinyInteger('show_phone_on_viedo')->nullable();
            $table->tinyInteger('force_headphones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('force_face_detecting');
            $table->dropColumn('speak_user_phone');
            $table->dropColumn('show_phone_on_viedo');
            $table->dropColumn('force_headphones');
        });
    }
};
