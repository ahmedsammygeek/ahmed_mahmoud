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
        Schema::create('student_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('course_unit_lesson_id');
            $table->integer('user_id');
            $table->integer('student_id');
            $table->tinyInteger('allowed')->default(1);
            $table->integer('total_views_till_now')->comment('total views unitll now');
            $table->integer('allowed_views')->comment('allowed view count put to this student');
            $table->integer('remains_views')->comment('remains views for this student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_lessons');
    }
};
