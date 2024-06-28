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
        Schema::table('course_teacher_group_students', function (Blueprint $table) {
            $table->dropColumn('deposit');
            $table->dropColumn('purchase_price');
            $table->dropColumn('not_allow_message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_teacher_group_students', function (Blueprint $table) {
            $table->double('deposit');
            $table->double('purchase_price');
            $table->string('not_allow_message')->nullable();
        });
    }
};
