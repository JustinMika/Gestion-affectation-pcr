<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['Administrateur', 'agent'];

        foreach ($roles as $value) {
            \App\Models\Role::firstOrCreate(['name' => $value, 'guard_name' => 'web']);
        }

        \App\Models\User::factory(1)->create([
            'name' => "Admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'active' => 1,
            'email_verified_at' => now(),
            'phone' => '243000000000'
        ]);

        \App\Models\User::factory(50)->create();
    }
}
