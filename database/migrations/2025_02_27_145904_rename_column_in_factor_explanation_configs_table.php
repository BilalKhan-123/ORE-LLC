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
        Schema::table('factor_explanation_configs', function (Blueprint $table) {
            $table->renameColumn('profile_summary_text_for_table', 'profile_summary_text_for_individual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factor_explanation_configs', function (Blueprint $table) {
            $table->renameColumn('profile_summary_text_for_individual', 'profile_summary_text_for_table');
        });
    }
};
