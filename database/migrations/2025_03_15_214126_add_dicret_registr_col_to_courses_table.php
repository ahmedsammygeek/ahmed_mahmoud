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
        Schema::table('courses', function (Blueprint $table) {
            $table->tinyInteger('direct_register');
            $table->tinyInteger('students_count_status')->default(1)->comment('1 real 2 fake 3 do not show ');
            $table->integer('fake_students_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('direct_register');
            $table->dropColumn('students_count_status');
            $table->dropColumn('fake_students_count');
        });
    }
};
