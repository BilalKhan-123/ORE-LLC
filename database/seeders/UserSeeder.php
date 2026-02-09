<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'biocognitive@gmail.com',
            'password' => '7$pan@2015',
            'email_verified_at' => Carbon::now(),
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);

        $admin->assignRole(config('site.roles.admin'));

        $client = User::create(
            [
                'first_name' => 'Client',
                'last_name' => 'User',
                'email' => 'binal@7span.com',
                'password' => '7$pan@2015',
                'client_code' => '123456',
                'email_verified_at' => Carbon::now(),
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ]
        );

        $client->purchasedExams()->create([
            'exam_type' => config('site.exam.exam_type.cci'),
            'quantity' => 10,
            'payment_by' => config('site.roles.admin'),
            'status' => config('site.payment_status.paid'),
        ]);

        $client->clientMetadata()->create([
            'total_cci_count' => 10,
            'conducted_cci_count' => 0,
            'total_glycan_count' => 0,
            'conducted_glycan_count' => 0,
            'number_of_participants' => 0,
        ]);

        $client->assignRole(config('site.roles.client'));

        $participant = User::create([
            'first_name' => 'Participant',
            'last_name' => 'User',
            'email' => 'meet@7span.com',
            'password' => '7$pan@2015',
            'email_verified_at' => Carbon::now(),
            'created_by' => 1,
            'created_at' => Carbon::now(),
        ]);

        $participant->assignRole(config('site.roles.user'));
    }
}
