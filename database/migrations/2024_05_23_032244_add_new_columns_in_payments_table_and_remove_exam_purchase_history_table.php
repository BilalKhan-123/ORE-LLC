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
        Schema::table('payments', function (Blueprint $table) {
            Schema::drop('client_exam_purchase_histories');

            $table->integer('quantity')->default(1)->after('exam_type');
            $table->decimal('discount_amount', 8, 2)->nullable()->after('quantity');
            $table->string('payment_by')->nullable()->after('amount');

            $table->string('discount_id')->nullable()->after('invoice_url');
            $table->string('promotion_code_id')->nullable()->after('coupon_code');
            $table->string('promotion_code')->nullable()->after('promotion_code_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('discount_amount');
            $table->dropColumn('payment_by');
            $table->dropColumn('discount_id');
            $table->dropColumn('promotion_code_id');
            $table->dropColumn('promotion_code');
        });
    }
};
