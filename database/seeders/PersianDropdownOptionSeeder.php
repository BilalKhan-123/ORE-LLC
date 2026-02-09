<?php

namespace Database\Seeders;

use App\Models\Factor;
use App\Models\DropdownOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersianDropdownOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labelsPersianIndexed = [
            'Asian' => 'آسیایی',
            'Hispanic/Latino' => 'هیسپانیک/لاتین',
            'Bi/Multiracial' => 'دو‌نژادی / چند‌نژادی',
            'Black' => 'سیاه‌پوست',
            'White/Caucasian' => 'سفیدپوست/قفقازی',
            'Race not listed' => 'نژاد ذکر نشده',
            'Gastroenteritis' => 'گاستروانتریت (التهاب معده و روده)',
            'Type 2 Diabetes' => 'دیابت نوع ۲',
            'Arthritis' => 'آرتریت (التهاب مفاصل)',
            'High Blood Pressure' => 'فشار خون بالا',
        ];

        foreach ($labelsPersianIndexed as $name => $faLabel) {
            DB::table('dropdown_options')->where('name', $name)->update([
                'name_fa' => $faLabel
            ]);
        }
    }
}
