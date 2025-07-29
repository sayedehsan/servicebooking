<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Cleaning Service',
            'description' => 'Professional cleaning service for homes and offices.',
            'price' => 1500.00,
            'currency' => 'BDT',
            'status' => 'active',
        ]);

        Service::create([
            'name' => 'Plumbing Service',
            'description' => 'Expert plumbing services for all your needs.',
            'price' => 2000.00,
            'currency' => 'BDT',
            'status' => 'active',
        ]);

        Service::create([
            'name' => 'Electrical Service',
            'description' => 'Reliable electrical services for residential and commercial properties.',
            'price' => 2500.00,
            'currency' => 'BDT',
            'status' => 'active',
        ]);
    }
}
