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
        Schema::table('course_teacher_groups', function (Blueprint $table) {
            $table->renameColumn('course_teacher_id' , 'course_id' );
        });

        Schema::rename('course_teacher_groups', 'groups' );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('groups', 'course_teacher_groups' );
        
        Schema::table('course_teacher_groups', function (Blueprint $table) {
            $table->renameColumn('course_id' , 'course_teacher_id' );
        });

    }
};