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
        $client1 = Client::create([
            'reservation_number'=>123,
            'reservation_status'=>'pending',
            'package'=>'343',
            'launch_date'=>Carbon::now()->addDays(10),
            'seat_number'=>'10',
            'gender'=>'male',
            'identity_number'=>'327389293047347',
            'country'=>'country one',
            'city'=>'city one',
            'parent_id'=>null,
            'supervisor_id'=>2,
        ]);
        $client2 = Client::create([
            'reservation_number'=>123,
            'reservation_status'=>'pending',
            'package'=>'343',
            'launch_date'=>Carbon::now()->addDays(20),
            'seat_number'=>'12',
            'gender'=>'female',
            'identity_number'=>'43743445453434',
            'country'=>'country two',
            'city'=>'city two',
            'parent_id'=>null,
            'supervisor_id'=>2,
        ]);

        $client1->user()->create([
            'name'=>'Client 1',
            'phone'=>'01140162540',
            'password'=>'123456',
            'type'=>3,
            'is_active'=>1,
            'lat'=>'34.43434',
            'lng'=>'5454545.454',
        ]);
        $client2->user()->create([
            'name'=>'Client 2',
            'phone'=>'01032551828',
            'password'=>'123456',
            'type'=>3,
            'is_active'=>1,
            'lat'=>'34.43434',
            'lng'=>'5454545.454',
        ]);

    }
}
