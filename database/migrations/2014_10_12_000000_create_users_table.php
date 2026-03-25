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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('lang_country')->default('en');
            $table->string('password');
            $table->string('language')->default('en');
            $table->string('mobile_no')->nullable();
            $table->integer('participants_limit')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('zipcode')->nullable();
            $table->text('address')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('living_status')->nullable();
            $table->string('status')->default('active');
            $table->boolean('allow_multiple_attempts')->default(false);
            $table->string('stripe_customer_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
