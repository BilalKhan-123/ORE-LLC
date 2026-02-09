<?php

namespace Database\Seeders;

use App\Models\Factor;
use App\Models\DropdownOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersianOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labelsPersianIndexed = [
            'Strongly Disagree' => 'کاملاً مخالفم',
            'Disagree' => 'مخالفم',
            'Neither Agree Nor Disagree' => 'نه موافقم و نه مخالف',
            'Agree' => 'موافقم',
            'Strongly Agree' => 'کاملاً موافقم',
        ];

        foreach ($labelsPersianIndexed as $label => $faLabel) {
            DB::table('options')->where('label', $label)->update([
                'label_fa' => $faLabel
            ]);
        }
    }
}
