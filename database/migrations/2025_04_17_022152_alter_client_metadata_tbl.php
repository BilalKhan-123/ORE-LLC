<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('client_metadata', function (Blueprint $table) {
            $table->bigInteger('total_cci_plus_count')->default(0)->after('conducted_glycan_count');
            $table->bigInteger('conducted_cci_plus_count')->default(0)->after('total_cci_plus_count');

            $table->bigInteger('total_cci_consultation_count')->default(0)->after('conducted_cci_plus_count');
            $table->bigInteger('conducted_cci_consultation_count')->default(0)->after('total_cci_consultation_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_metadata', function (Blueprint $table) {
            $table->dropColumn([
                'total_cci_plus_count',
                'conducted_cci_plus_count',
                'total_cci_consultation_count',
                'conducted_cci_consultation_count',
            ]);
        });
    }
};
