<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galary;

class GalarySeeder extends Seeder
{
    public function run(): void
    {
        Galary::factory()->count(12)->create();
    }
}
