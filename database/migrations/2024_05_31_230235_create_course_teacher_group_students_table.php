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
        Schema::create('course_teacher_group_students', function (Blueprint $table) {
            $table->id();
            $table->integer('course_teacher_group_id');
            $table->integer('student_id');
            $table->integer('user_id');
            $table->double('deposit')->default(0);
            $table->tinyInteger('allow')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_teacher_group_students');
    }
};
