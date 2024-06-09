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
        Schema::create('course_unit_lessons', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('content')->nullable();
            $table->integer('course_unit_id');
            $table->integer('user_id');
            $table->tinyInteger('is_active');
            $table->integer('allowed_views')->nullable();
            $table->double('lesson_mins')->nullable();
            $table->text('lesson_video_link');
            $table->string('lesson_video_driver')->default('youtube');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_unit_lessons');
    }
};
