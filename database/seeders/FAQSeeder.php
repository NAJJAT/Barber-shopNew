<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAQCategory;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'General Questions' => [
                ['question' => 'What are your working hours?', 'answer' => 'We are open from 9 AM to 9 PM.'],
                ['question' => 'Do I need an appointment?', 'answer' => 'Walk-ins are welcome, but appointments are preferred.']
            ],
            'Pricing' => [
                ['question' => 'How much does a haircut cost?', 'answer' => 'Our haircuts start at $15.'],
                ['question' => 'Do you offer discounts?', 'answer' => 'Yes, we have a loyalty program.']
            ]
        ];
    
        foreach ($categories as $categoryName => $faqs) {
            $category = FAQCategory::create(['name' => $categoryName]);
    
            foreach ($faqs as $faq) {
                FAQ::create([
                    'faq_category_id' => $category->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer']
                ]);
            }
        }
    }
}
