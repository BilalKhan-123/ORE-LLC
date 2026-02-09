<?php

namespace Database\Seeders;

use DB;
use Storage;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = Storage::disk('database')->get('states.sql');
        DB::connection()->getPdo()->exec($sql);
    }
}
