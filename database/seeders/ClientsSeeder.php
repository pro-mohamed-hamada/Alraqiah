<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Carbon\Carbon;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = Client::create([
            'reservation_number'=>123,
            'reservation_status'=>'pending',
            'package'=>'343',
            'launch_date'=>Carbon::now()->addDays(10),
            'seat_number'=>'10',
            'gender'=>'male',
            'national_number'=>'327389293047347',
            'lat'=>'34.43434',
            'lng'=>'5454545.454',
            'city'=>'city one',
            'parent_id'=>null,
        ]);
        $client = Client::create([
            'reservation_number'=>123,
            'reservation_status'=>'pending',
            'package'=>'343',
            'launch_date'=>Carbon::now()->addDays(20),
            'seat_number'=>'12',
            'gender'=>'female',
            'national_number'=>'43743445453434',
            'lat'=>'34.43434',
            'lng'=>'5454545.454',
            'city'=>'city two',
            'parent_id'=>null,
        ]);
    }
}
