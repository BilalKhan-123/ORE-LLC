<?php

namespace Database\Seeders;

use DB;
use Storage;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $sql = Storage::disk('database')->get('countries.sql');
        DB::connection()->getPdo()->exec($sql);
    }
}
