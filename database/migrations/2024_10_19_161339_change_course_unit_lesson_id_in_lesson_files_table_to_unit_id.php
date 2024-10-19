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
        Schema::table('lesson_files', function (Blueprint $table) {
            $table->renameColumn('course_unit_lesson_id', 'lesson_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_files', function (Blueprint $table) {
            $table->renameColumn('lesson_id', 'course_unit_lesson_id');
        });
    }
};
