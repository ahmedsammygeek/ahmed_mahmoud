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
            $table->renameColumn('course_teacher_group_id', 'group_id');
        });

        Schema::rename('course_teacher_group_students', 'group_students' );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::rename('group_students', 'course_teacher_group_students' );

        Schema::table('course_teacher_group_students', function (Blueprint $table) {
            $table->renameColumn('group_id' , 'course_teacher_group_id');
        });

    }
};
