<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'label' => 'Strongly Disagree',
                'label_pl' => 'Kategorycznie się nie zgadzam',
                'label_de' => 'Entschieden widersprechen',
                'label_pt' => 'Discordo fortemente',
                'label_es' => 'Totalmente en desacuerdo',
                'label_fr' => 'Fortement en désaccord',
                'label_it' => 'Decisamente in disaccordo',
                'forward_points' => -2,
                'backward_points' => 5,
                'created_at' => Carbon::now(),
            ],
            [
                'label' => 'Disagree',
                'label_pl' => 'Nie zgadzać się',
                'label_de' => 'Verschiedener Meinung sein',
                'label_pt' => 'Discordo',
                'label_es' => 'En desacuerdo',
                'label_fr' => 'En désaccord',
                'label_it' => 'In disaccordo',
                'forward_points' => -1,
                'backward_points' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'label' => 'Neither Agree Nor Disagree',
                'label_pl' => 'Ani się zgadzam, ani się nie zgadzam',
                'label_de' => 'Weder zustimmen noch abstreiten',
                'label_pt' => 'Não concordo nem discordo',
                'label_es' => 'Ni de acuerdo ni en desacuerdo',
                'label_fr' => 'Ni d\'accord ni en désaccord',
                'label_it' => 'Né d\'accordo né in disaccordo',
                'forward_points' => 0,
                'backward_points' => 0,
                'created_at' => Carbon::now(),
            ],
            [
                'label' => 'Agree',
                'label_pl' => 'Zgadzać się',
                'label_de' => 'Zustimmen',
                'label_pt' => 'Concordar',
                'label_es' => 'De acuerdo',
                'label_fr' => 'D\'accord',
                'label_it' => 'D\'accordo',
                'forward_points' => 4,
                'backward_points' => -1,
                'created_at' => Carbon::now(),
            ],
            [
                'label' => 'Strongly Agree',
                'label_pl' => 'Stanowczo się zgadzam',
                'label_de' => 'Stimme voll und ganz zu',
                'label_pt' => 'Concordo plenamente',
                'label_es' => 'Totalmente de acuerdo',
                'label_fr' => 'Totalement d\'accord',
                'label_it' => 'Decisamente d\'accordo',
                'forward_points' => 5,
                'backward_points' => -2,
                'created_at' => Carbon::now(),
            ],
        ];

        Option::insert($options);
    }
}
