<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relative;

class RelativesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relative1 = Relative::create([
            'name'=>'relative 1',
            'gender'=>'male',
            'identity_number'=>'123944729323434',
            'seat_number'=>'1501',
            'country'=>'country one',
            'city'=>'city one',
            'client_id'=>1,
        ]);
        $relative2 = Relative::create([
            'name'=>'relative 2',
            'gender'=>'female',
            'identity_number'=>'74382320384374',
            'seat_number'=>'1502',
            'country'=>'country two',
            'city'=>'city two',
            'client_id'=>1,
        ]);
    }
}
