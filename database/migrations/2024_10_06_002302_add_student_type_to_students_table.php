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
        Schema::table('students', function (Blueprint $table) {
            $table->tinyInteger('type')->default(1);
            $table->integer('university_id')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('faculty_level_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('university_id');
            $table->dropColumn('faculty_id');
            $table->dropColumn('faculty_level_id');
        });
    }
};
