<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relative;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'primary_phone'=>'43629328323',
            'whatsapp_phone'=>'46738473374',
            'email'=>'elhamlaalraqiah@alraqiah.com',
            'about_us'=>'this is the about us section',
            'terms_and_conditions'=>'this is the terms and condtions',
            'rate'=>'0.0',
        ]);
    }
}
