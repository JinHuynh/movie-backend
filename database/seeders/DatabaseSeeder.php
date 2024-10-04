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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Gọi seeder cho bảng users
        $this->call([
            UsersTableSeeder::class,
            PackageSeeder::class,
            VoucherTypeSeeder::class,
            VoucherSeeder::class,
        ]);
    }
}
