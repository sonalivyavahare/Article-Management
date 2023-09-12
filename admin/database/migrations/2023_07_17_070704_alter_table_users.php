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
            $table->after('name', function ($table) {
                $table->string('username', '50')->nullable();
                $table->integer('user_role')->default(1);
                $table->integer('is_active')->default(1);
                $table->string('profile_image', '255')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('user_role');
            $table->dropColumn('is_active');
            $table->dropColumn('profile_image');
        });
    }
};
