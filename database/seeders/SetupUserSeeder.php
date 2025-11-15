<?php

namespace Database\Seeders;

use App\Models\UserCandidate;
use App\Models\UserEmployer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCandidate::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '085981733',
            'address' => 'Korea Selatan',
            'description' => 'Software Engineer',
        ]);

        UserEmployer::create([
            'name' => 'XYZ Company',
            'email' => 'xyz.company@example.com',
            'password' => bcrypt('12345678'),
            'address' => 'Korea Selatan',
            'description' => 'Perusahaan Artificial Intelligence di Korea',
            'company_size' => '< 10',
            'website' => 'https://www.example.com',
            'specialization' => 'Software Development, Artificial Intelligence, Image Recognition'
        ]);
    }
}
