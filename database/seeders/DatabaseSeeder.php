<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Role, Admin};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'name' => 'Super Administrador',
            'email' => 'admin@bbshop.com',
            'email_verified_at' => now(),
            'password' => 'admin123',
            'remember_token' => Str::random(10),
        ]);

        $rol = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'admin',
        ]);

        $admin->assignRole($rol);

        Artisan::call('permissions:sync');
    }
}
