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
        Schema::create('user_contact_messages', function (Blueprint $table) {
            $table->id();

            // Basic contact details
            $table->string('name')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('email')->nullable();

            // Message details
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();

            // Response tracking
            $table->boolean('is_responded')->default(false);
            $table->timestamp('responded_at')->nullable();
            $table->unsignedBigInteger('responded_by')->nullable(); // user/admin who responded

            // Visibility and status
            $table->tinyInteger('is_show')->default(1);
            $table->enum('status', ['new', 'in_progress', 'resolved', 'archived'])->default('new');

            // Metadata
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            // Audit fields
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Optional foreign keys (if you have users table)
            // $table->foreign('responded_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contact_messages');
    }
};
