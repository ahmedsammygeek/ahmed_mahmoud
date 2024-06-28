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
        Schema::table('exams', function (Blueprint $table) {
            $table->longText('title');
            $table->integer('duration');
            $table->tinyInteger('can_user_re_exam')->default(0);
            $table->double('min_degree_to_re_exam')->nullable();
            $table->double('total_degree')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('duration');
            $table->dropColumn('can_user_re_exam');
            $table->dropColumn('min_degree_to_re_exam');
            $table->dropColumn('total_degree');
        });
    }
};
