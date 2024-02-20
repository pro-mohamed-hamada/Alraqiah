<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'011111',
            'password'=>'123456',
            'type'=>1,
            'is_active'=>1,
        ]);
        User::create([
            'name'=>'employee 1',
            'email'=>'emp1@gmail.com',
            'phone'=>'022222',
            'password'=>'123456',
            'type'=>2,
            'is_active'=>1,
        ]);
        User::create([
            'name'=>'Client 1',
            'phone'=>'01140162540',
            'password'=>'123456',
            'type'=>3,
            'is_active'=>1,
            'client_id'=>1,
        ]);
        User::create([
            'name'=>'Client 2',
            'phone'=>'01032551828',
            'password'=>'123456',
            'type'=>3,
            'is_active'=>1,
            'client_id'=>2,
        ]);
    }
}
