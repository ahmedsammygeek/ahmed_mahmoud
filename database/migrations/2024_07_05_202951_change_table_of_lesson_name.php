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
        Schema::rename('course_unit_lessons', 'lessons');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('lessons', 'course_unit_lessons');
    }
};
