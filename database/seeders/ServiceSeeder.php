<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
        public function run()
        {
            Service::create([
                'name' => 'Classic Haircut',
                'description' => 'A classic haircut for a sharp look.',
                'price' => 25.00,
                'duration' => 30,
            ]);
    
            Service::create([
                'name' => 'Beard Trim',
                'description' => 'Neat and clean beard trim.',
                'price' => 15.00,
                'duration' => 20,
            ]);
        }
    }