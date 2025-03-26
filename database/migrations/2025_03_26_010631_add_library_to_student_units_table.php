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
        Schema::table('student_units', function (Blueprint $table) {
            // $table->tinyInteger('library_is_allowed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_units', function (Blueprint $table) {
            // $table->dropColumn('library_is_allowed');
        });
    }
};
