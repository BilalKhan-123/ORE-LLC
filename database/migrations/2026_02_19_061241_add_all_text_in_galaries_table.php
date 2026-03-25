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
        Schema::table('galaries', function (Blueprint $table) {
            $table->longText('all_text')->nullable()->after('main_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galaries', function (Blueprint $table) {
            $table->dropColumn('all_text');
        });
    }
};
