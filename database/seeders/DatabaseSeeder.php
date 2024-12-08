<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ClinicCategory;
use App\Models\ClinicPhone;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            RegionSeeder::class,
            CitySeeder::class,
            ServiceTypeSeeder::class,
            ServiceCategorySeeder::class,
            CategorySeeder::class,
        ]);

        for ($i = 0; $i <= 40; $i++) {
            Clinic::factory()
                ->has(ClinicPhone::factory(random_int(1, 2)), 'clinic_phones')
                ->has(ClinicCategory::factory(1), 'clinic_categories')
                ->create();
        }
    }
}
