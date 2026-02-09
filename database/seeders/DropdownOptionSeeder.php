<?php

namespace Database\Seeders;

use App\Models\DropdownOption;
use Illuminate\Database\Seeder;

class DropdownOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dropdownOptions = [
            [
                'value' => 'asian',
                'name' => 'Asian',
                'name_pl' => 'Azjatycki',
                'name_pt' => 'Asiática',
                'name_de' => 'asiatisch',
                'name_es' => 'asiático',
                'name_fr' => 'asiatisch',
                'name_it' => 'asiatico',
                'type' => config('site.user_form.option.ethnic_group'),
            ],
            [
                'value' => 'hispanic/latino',
                'name' => 'Hispanic/Latino',
                'name_pl' => 'Hiszpanie/Latynosi',
                'name_pt' => 'Hispânico/Latino',
                'name_de' => 'Hispanisch/Latino',
                'name_es' => 'hispano/latino',
                'name_fr' => 'Hispanique/latin',
                'name_it' => 'ispanico/latino',
                'type' => config('site.user_form.option.ethnic_group'),
            ],
            [
                'value' => 'bi/multiracial',
                'name' => 'Bi/Multiracial',
                'name_pl' => 'Bi/wielorasowy',
                'name_pt' => 'Bi/Multirracial',
                'name_de' => 'Bi/gemischtrassig',
                'name_es' => 'bi/multirracial',
                'name_fr' => 'bi/multiracial',
                'name_it' => 'bi/multirazziale',
                'type' => config('site.user_form.option.ethnic_group'),
            ],
            [
                'value' => 'black',
                'name' => 'Black',
                'name_pl' => 'Czarny',
                'name_pt' => 'Preta',
                'name_de' => 'Schwarz',
                'name_es' => 'Negro',
                'name_fr' => 'Noir',
                'name_it' => 'Nero',
                'type' => config('site.user_form.option.ethnic_group'),
            ],
            [
                'value' => 'white/caucasian',
                'name' => 'White/Caucasian',
                'name_pl' => 'Biały/kaukaski',
                'name_pt' => 'Branco/Caucasiano',
                'name_de' => 'Weiß/Kaukasier',
                'name_es' => 'Blanco/Caucásico',
                'name_fr' => 'Blanc/Caucasien',
                'name_it' => 'Bianco/Caucasico',
                'type' => config('site.user_form.option.ethnic_group'),
            ],
            [
                'value' => 'race_not_listed',
                'name' => 'Race not listed',
                'name_pl' => 'Rasa nie wymieniona',
                'name_pt' => 'Raça não listada',
                'name_de' => 'Rennen nicht aufgeführt',
                'name_es' => 'Raza no listada',
                'name_fr' => 'Race non répertoriée',
                'name_it' => 'Razza non elencata',
                'type' => config('site.user_form.option.ethnic_group'),
            ],
            [
                'value' => 'gastroenteritis',
                'name' => 'Gastroenteritis',
                'name_pl' => 'Nieżyt żołądka i jelit',
                'name_pt' => 'Gastroenterite',
                'name_de' => 'Gastroenteritis',
                'name_es' => 'Gastroenteritis',
                'name_fr' => 'Gastro-entérite',
                'name_it' => 'Gastroenterite',
                'type' => config('site.user_form.option.major_illness'),
            ],
            [
                'value' => 'type_2_diabetes',
                'name' => 'Type 2 Diabetes',
                'name_pl' => 'Cukrzyca typu 2',
                'name_pt' => 'Diabetes tipo 2',
                'name_de' => 'Typ 2 Diabetes',
                'name_es' => 'Diabetes tipo 2',
                'name_fr' => 'Diabète de type 2',
                'name_it' => 'Diabete di tipo 2',
                'type' => config('site.user_form.option.major_illness'),
            ],
            [
                'value' => 'arthritis',
                'name' => 'Arthritis',
                'name_pl' => 'Artretyzm',
                'name_pt' => 'Artrite',
                'name_de' => 'Arthritis',
                'name_es' => 'Artritis',
                'name_fr' => 'Arthrite',
                'name_it' => 'Artrite',
                'type' => config('site.user_form.option.major_illness'),
            ],
            [
                'value' => 'high_blood_pressure',
                'name' => 'High Blood Pressure',
                'name_pl' => 'Wysokie ciśnienie krwi',
                'name_pt' => 'Bluthochdruck',
                'name_de' => 'Pressão alta',
                'name_es' => 'Presión arterial alta',
                'name_fr' => 'Hypertension artérielle',
                'name_it' => 'Pressione alta',
                'type' => config('site.user_form.option.major_illness'),
            ],
        ];

        DropdownOption::insert($dropdownOptions);
    }
}
