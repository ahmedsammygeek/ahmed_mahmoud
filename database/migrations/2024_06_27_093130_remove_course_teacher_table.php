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
        Schema::dropIfExists('course_teachers');

 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('course_teachers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('course_id');
            $table->tinyInteger('teacher_id');
            $table->timestamps();
        });
    }
};