<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'rostik057@gmail.com';

        $data = [
            'name' => 'Test',
            'email' => $email,
            'phone' => '88005553535',
            'password' => $email,
            'role' => UserRole::admin
        ];

        $user = User::createOrFirst($data);
    }
}
