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
        Schema::create('student_installments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('student_id');
            $table->integer('course_id');
            $table->double('amount');
            $table->date('due_date')->nullable();
            $table->tinyInteger('is_paid')->default(0);
            $table->integer('student_payment_id')->nullable();
            $table->integer('change_to_paid_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_installments');
    }
};
