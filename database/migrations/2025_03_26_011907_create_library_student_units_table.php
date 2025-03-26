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
        Schema::create('library_student_units', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->integer('unit_id');
            $table->tinyInteger('is_allowed')->default(1);
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_student_units');
    }
};
