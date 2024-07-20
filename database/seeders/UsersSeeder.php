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
            'email'=>'mahmoudabkareno12345@gmail.com',
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
            'whatsapp_url'=>'https://www.web.whatsapp.com',
        ]);
    }
}
