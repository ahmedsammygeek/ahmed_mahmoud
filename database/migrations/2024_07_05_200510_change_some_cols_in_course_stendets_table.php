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
            $table->dropColumn('deposit');
            $table->dropColumn('purchase_price');
            $table->renameColumn('not_allow_message' , 'disable_reason' );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_students', function (Blueprint $table) {
            $table->doubel('deposit');
            $table->doubel('purchase_price');
            $table->renameColumn( 'disable_reason' ,  'not_allow_message'  );
        });
    }
};
