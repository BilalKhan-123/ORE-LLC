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
        $tables = ['abouts', 'banners', 'contacts', 'departments', 'services'];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'all_text')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->longText('all_text')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['abouts', 'banners', 'contacts', 'departments', 'services'];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'all_text')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('all_text');
                });
            }
        }
    }
};
