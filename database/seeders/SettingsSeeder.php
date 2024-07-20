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
            'elhamla_male_doctor_number'=>'54545434',
            'elhamla_female_doctor_number'=>'4545345',
            'mufti_number'=>'545454545',
            'point_one_lat'=>'30.945913',
            'point_one_lng'=>'29.083358',
            'point_two_lat'=>'31.101596',
            'point_two_lng'=>'29.078918',
            'point_three_lat'=>'30.921598',
            'point_three_lng'=>'29.169901',
            'point_four_lat'=>'31.130560',
            'point_four_lng'=>'29.147500',
        ]);
    }
}
