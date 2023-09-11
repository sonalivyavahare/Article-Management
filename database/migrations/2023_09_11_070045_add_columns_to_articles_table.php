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
        Schema::table('articles', function (Blueprint $table) {
           $table->after('slug', function ($table) {
                $table->string('author', '255')->nullable();
                $table->timestamp('publish_date')->nullable();
                $table->integer('status')->default(1);
                $table->string('summary', '255')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('author');
            $table->dropColumn('publish_date');
            $table->dropColumn('status');
            $table->dropColumn('summary');
        });
    }
};
