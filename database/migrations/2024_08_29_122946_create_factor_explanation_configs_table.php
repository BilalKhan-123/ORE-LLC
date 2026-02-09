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
        Schema::create('factor_explanation_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id')->nullable();
            $table->text('factor')->nullable();
            $table->text('language')->nullable();
            $table->text('name')->nullable();
            $table->text('score_label')->nullable();
            $table->text('high_score')->nullable();
            $table->text('low_score')->nullable();
            $table->text('high_score_suggestion')->nullable();
            $table->text('low_score_suggestion')->nullable();
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factor_explanation_configs');
    }
};
