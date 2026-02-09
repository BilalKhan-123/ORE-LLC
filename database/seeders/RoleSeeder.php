<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'api',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'client',
                'guard_name' => 'api',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'participant',
                'guard_name' => 'api',
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
