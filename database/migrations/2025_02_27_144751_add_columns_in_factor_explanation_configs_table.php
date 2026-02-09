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
            $table->text('main_summary_text_for_individual')->nullable();
            $table->text('sub_summary_text_for_individual')->nullable();
            $table->text('main_summary_text_for_table')->nullable();
            $table->text('sub_summary_text_for_table')->nullable();
            $table->text('profile_summary_text_for_table')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema:table('factor_explanation_configs', function (Blueprint $table) {
            $table->dropColumn(['main_summary_text_for_individual','sub_summary_text_for_individual','main_summary_text_for_table','sub_summary_text_for_table','profile_summary_text_for_table']);
        });
    }
};
