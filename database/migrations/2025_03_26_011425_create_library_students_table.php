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
        Schema::create('library_students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->tinyInteger('is_allowed');
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
            $table->tinyInteger('force_water_mark')->default(1);
            $table->integer('allowed_downloads_number')->nullable();
            $table->integer('allowed_views_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_students');
    }
};
