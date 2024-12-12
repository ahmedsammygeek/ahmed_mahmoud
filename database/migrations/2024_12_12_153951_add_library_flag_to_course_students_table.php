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
        Schema::table('course_students', function (Blueprint $table) {
            $table->tinyInteger('is_online')->default(1);
            $table->tinyInteger('in_office')->default(1);
            $table->tinyInteger('office_library')->default(1);
            $table->tinyInteger('online_library')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_students', function (Blueprint $table) {
            $table->dropColumn('is_online');
            $table->dropColumn('in_office');
            $table->dropColumn('office_library');
            $table->dropColumn('online_library');
        });
    }
};
