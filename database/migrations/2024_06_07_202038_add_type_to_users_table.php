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
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('type')->default(1)->comment('1 admin , 2 teacher , 3 assestant');
            $table->tinyInteger('show_in_suggested_in_app')->default(0)->comment('1 means yes 0 means no');
            $table->text('image')->nullable();
            $table->text('bio')->nullable();
            $table->text('mobile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('show_in_suggested_in_app');
            $table->dropColumn('image');
            $table->dropColumn('bio');
            $table->dropColumn('mobile');
        });
    }
};
