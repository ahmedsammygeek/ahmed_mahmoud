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
        Schema::table('settings', function (Blueprint $table) {
            $table->tinyInteger('force_phone_verification')->default(0);
            $table->dropColumn('lesson_mins_to_be_viewed');
            $table->dropColumn('show_phone_on_viedo');
            $table->dropColumn('speak_user_phone');
            $table->dropColumn('speak_user_phone_every');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('force_phone_verification');
            $table->tinyInteger('show_phone_on_viedo');
            $table->tinyInteger('speak_user_phone');
            $table->integer('speak_user_phone_every');
            $table->integer('lesson_mins_to_be_viewed');
        });
    }
};
