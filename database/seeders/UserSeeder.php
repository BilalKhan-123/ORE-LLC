<?php
namespace Database\Seeders;

use App\Library\Helper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        $admin = User::create([
            'first_name' => 'Optimus',
            'last_name' => 'Ussr',
            'username' => 'admin',
            'email' => 'Optimusrevenuellc@gmail.com',
            'password' => 'Orellc@2026',
            'lang_country' => 'en',
            'language' => 'en',
            'status' => 'active',
            'email_verified_at' => Carbon::now(),
        ]);

        $admin->assignRole(config('site.roles.admin'));

    }
}
