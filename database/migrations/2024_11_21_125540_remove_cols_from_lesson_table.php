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
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('lesson_mins');
            $table->dropColumn('lesson_video_link');
            $table->dropColumn('lesson_video_driver');
            $table->dropColumn('is_free');
            $table->dropColumn('video_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->double('lesson_mins');
            $table->text('lesson_video_link');
            $table->string('lesson_video_driver');
            $table->tinyInteger('is_free');
            $table->string('video_id');
        });
    }
};
