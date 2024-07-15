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
        Schema::table('student_exam_answers', function (Blueprint $table) {
            $table->text('correct_answer_content')->nullable();
            $table->tinyInteger('is_marked')->nullable(0);
            $table->integer('marked_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_exam_answers', function (Blueprint $table) {
            $table->dropColumn('correct_answer_content');
            $table->dropColumn('is_marked');
            $table->dropColumn('marked_by');
        });
    }
};
