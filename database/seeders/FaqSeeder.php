<?php

namespace Database\Seeders;

use App\Models\faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        faq::create([
            'question' => 'What is your name?',
            'answer' => 'McSonia Technologies.'
        ]);
        faq::create([
            'question' => 'What is your business?',
            'answer' => 'We\'re in the logistics business'
        ]);
    }
}
