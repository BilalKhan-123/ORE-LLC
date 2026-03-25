<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AboutSeeder::class,
            BannerSeeder::class,
            ServiceSeeder::class,
            DepartmentSeeder::class,
            GalarySeeder::class,
            ContactSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
