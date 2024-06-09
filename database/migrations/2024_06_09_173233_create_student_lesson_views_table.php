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
        Schema::create('student_lesson_views', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('course_unit_lesson_id');
            $table->integer('intial_views_number');
            $table->integer('remains_views_number');
            $table->integer('total_views_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_lesson_views');
    }
};
