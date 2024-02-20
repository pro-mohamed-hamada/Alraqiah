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
            'equestion'=>'equestion 1',
            'answer'=>'answer 1',
            'is_active'=>1,
        ]);
        $faq2 = Faq::create([
            'equestion'=>'equestion 2',
            'answer'=>'answer 2',
            'is_active'=>1,
        ]);
    }
}
