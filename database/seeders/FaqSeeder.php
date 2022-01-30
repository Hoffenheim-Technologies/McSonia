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
            'question' => 'What is the company name?',
            'answer' => 'McSonia Logistics Ltd.'
        ]);
        faq::create([
            'question' => 'What kind of Logistics Business are you into?',
            'answer' => 'We\'re in the logistics business.'
        ]);
        faq::create([
            'question' => 'How much does it cost per kilometer?',
            'answer' => 'Please contact our Admin dept to address that and many other questions that you may have.'
        ]);
        faq::create([
            'question' => 'How long does it take to ship my product from Ikeja to Ajah for example?',
            'answer' => 'Based on availability of our products, we get it there in as little as 4 hours.'
        ]);
        faq::create([
            'question' => 'Where is the office located?',
            'answer' => 'Our office is located in our Office in Oshodi, Lagos.'
        ]);
        faq::create([
            'question' => 'Do you guys ship to other states or only Lagos?',
            'answer' => 'Yes, we only ship to Lagos now but we plan to do in the nearest future.'
        ]);
        faq::create([
            'question' => 'What are the hours of operations?',
            'answer' => 'Mondays to Saturdays from 10am to 8pm.'
        ]);
    }
}
