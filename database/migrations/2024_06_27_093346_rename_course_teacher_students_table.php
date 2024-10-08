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
        Schema::rename('course_teacher_students', 'course_students' );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('course_students', 'course_teacher_students' );
    }
};
