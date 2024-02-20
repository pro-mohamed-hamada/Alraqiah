<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ClientsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RelativesSeeder::class);
        $this->call(FaqsSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
