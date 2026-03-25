<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DropTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Tables you want to drop
        $tables = [
            'age_groups',
            'answer_results',
            'answers',
            'client_metadata',
            'dropdown_options',
            'factor_explanation_configs',
            'factors',
            'options',
            'participant_metadata',
            'questions',
            'user_describes',
            'user_major_illnesses',
            'client_exam_purchase_histories',
            'abouts',
            'banners',
            'departments',
            'faqs',
            'galaries',
            'services',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::drop($table);
            }
        }

        // Enable foreign key checks
        if (!app()->isLocal() && !app()->isStaging()) {
            $this->command->warn('Seeder blocked outside local/staging environment.');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return;
        }

        // Tables to truncate
        $truncateTables = [
            'admin_settings',
            'failed_jobs',
            'jobs',
            'migrations',
            'model_has_permissions',
            'model_has_roles',
            'password_reset_tokens',
            'payments',
            'permissions',
            'personal_access_tokens',
            'role_has_permissions',
            'user_otps',
            'telescope_entries',
            'telescope_entries_tags',
            'telescope_monitoring',
            'roles',
            'users',
        ];

        foreach ($truncateTables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        
    }
}
