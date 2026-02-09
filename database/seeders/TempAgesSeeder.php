<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TempAgesSeeder extends Seeder
{
    public function run(): void
    {
        $ageRanges = [
            ['min' => 7,   'max' => 12,  'label' => '7-12'],
            ['min' => 13,  'max' => 19,  'label' => '13-19'],
            ['min' => 20,  'max' => 29,  'label' => '20-29'],
            ['min' => 30,  'max' => 39,  'label' => '30-39'],
            ['min' => 40,  'max' => 50,  'label' => '40-50'],
            ['min' => 51,  'max' => 60,  'label' => '51-60'],
            ['min' => 61,  'max' => 71,  'label' => '61-71'],
            ['min' => 72,  'max' => 80,  'label' => '72-80'],
            ['min' => 81,  'max' => 90,  'label' => '81-90'],
            ['min' => 91,  'max' => 99,  'label' => '91-99'],
            ['min' => 100, 'max' => 105, 'label' => '100-105'],
            ['min' => 106, 'max' => 109, 'label' => '106-109'],
            ['min' => 110, 'max' => null,'label' => '110+'],
        ];

        User::whereNotNull('birthdate')->chunk(100, function ($users) use ($ageRanges) {
            foreach ($users as $user) {

                $age = Carbon::parse($user->birthdate)->age;
                $rangeLabel = null;

                foreach ($ageRanges as $range) {
                    if (
                        $age >= $range['min'] &&
                        ($range['max'] === null || $age <= $range['max'])
                    ) {
                        $rangeLabel = $range['label'];
                        break;
                    }
                }

                $user->update([
                    'chronological_age' => $age,
                    'chronological_age_range' => $rangeLabel,
                ]);
            }
        });
    }
}
