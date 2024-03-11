<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use App\Models\Relative;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faq1 = Faq::create([
            'question'=>'question 1',
            'answer'=>'answer 1',
            'is_active'=>1,
        ]);
        $faq2 = Faq::create([
            'question'=>'question 2',
            'answer'=>'answer 2',
            'is_active'=>1,
        ]);
    }
}
