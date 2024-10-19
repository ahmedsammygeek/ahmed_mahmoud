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
        Schema::create('lesson_file_views', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('lesson_file_id');
            $table->integer('total_views_till_now');
            $table->integer('total_downloads_till_now');
            $table->integer('allowed_views_number');
            $table->integer('allowed_downloads_number');
            $table->tinyInteger('force_water_mark')->default(0);
            $table->string('water_mark_text');
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_file_views');
    }
};
