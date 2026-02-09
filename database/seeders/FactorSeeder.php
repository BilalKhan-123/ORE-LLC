<?php

namespace Database\Seeders;

use App\Models\Factor;
use Illuminate\Database\Seeder;

class FactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factors = [
            ['name' => 'Time', 'type' => 'perception'],
            ['name' => 'Health', 'type' => 'perception'],
            ['name' => 'Aging', 'type' => 'perception'],
            ['name' => 'Self-Valuation', 'type' => 'perception'],
            ['name' => 'Generosity', 'type' => 'emotion'],
            ['name' => 'Gratitude', 'type' => 'emotion'],
            ['name' => 'Admiration', 'type' => 'emotion'],
            ['name' => 'Curiosity', 'type' => 'emotion'],
        ];

        foreach ($factors as $factor) {
            Factor::create($factor);
        }
    }
}
