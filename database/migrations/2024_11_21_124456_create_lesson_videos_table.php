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
        Schema::create('lesson_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('lesson_id');
            $table->longText('title')->nullable();
            $table->longText('content')->nullable();
            $table->integer('user_id');
            $table->tinyInteger('is_active');
            $table->integer('allowed_views');
            $table->integer('lesson_mins');
            $table->text('lesson_video_link');
            $table->text('lesson_video_driver');
            $table->tinyInteger('is_free');
            $table->string('video_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_videos');
    }
};
