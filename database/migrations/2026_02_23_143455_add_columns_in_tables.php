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
        // Abouts
        Schema::table('abouts', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable()->after('updated_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('added_by');
        });

        // Banners
        Schema::table('banners', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable()->after('updated_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('added_by');
        });

        // Contacts
        Schema::table('contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable()->after('updated_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('added_by');
        });

        // Departments
        Schema::table('departments', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable()->after('updated_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('added_by');
        });

        // FAQs
        Schema::table('faqs', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable()->after('updated_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('added_by');
        });

        // Galleries
        Schema::table('galaries', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable()->after('updated_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('added_by');
        });

        // Services
        Schema::table('services', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable()->after('updated_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('added_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn(['added_by', 'updated_by']);
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['added_by', 'updated_by']);
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['added_by', 'updated_by']);
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn(['added_by', 'updated_by']);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['added_by', 'updated_by']);
        });

        Schema::table('galaries', function (Blueprint $table) {
            $table->dropColumn(['added_by', 'updated_by']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['added_by', 'updated_by']);
        });
    }
};
