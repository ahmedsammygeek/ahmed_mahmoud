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
        Schema::create('student_units', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_id');
            $table->integer('student_id');
            $table->integer('user_id');
            $table->tinyInteger('is_allowed')->default(1);
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_units');
    }
};
