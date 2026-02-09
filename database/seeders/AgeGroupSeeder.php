<?php

namespace Database\Seeders;

use App\Models\AgeGroup;
use Illuminate\Database\Seeder;

class AgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AgeGroup::truncate();
        $ageGroupArr = [
            [
                'name' => 'Childhood',
                'min_age' => 6,
                'max_age' => 12,
            ],
            [
                'name' => 'Adolescent',
                'min_age' => 13,
                'max_age' => 19,
            ],
            [
                'name' => 'Young Adult',
                'min_age' => 20,
                'max_age' => 39,
            ],
            [
                'name' => 'Middle Age',
                'min_age' => 40,
                'max_age' => 59,
            ],
            [
                'name' => 'Older',
                'min_age' => 60,
                'max_age' => 99,
            ],
            [
                'name' => 'Centenarians',
                'min_age' => 100,
                'max_age' => 300,
            ],
        ];

        AgeGroup::insert($ageGroupArr);
    }
}
