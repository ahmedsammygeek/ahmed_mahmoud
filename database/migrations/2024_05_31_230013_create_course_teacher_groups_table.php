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
        Schema::create('course_teacher_groups', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->integer('user_id');
            $table->integer('course_teacher_id');
            $table->integer('max_students_limit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_teacher_groups');
    }
};
