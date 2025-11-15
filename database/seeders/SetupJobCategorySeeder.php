<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SetupJobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataCategory = [
            [
                'id' => Str::orderedUuid(),
                'name' => 'Teknologi Informasi dan Komunikasi',
            ],
            [
                'id' => Str::orderedUuid(),
                'name' => 'Pemasaran',
            ],
            [
                'id' => Str::orderedUuid(),
                'name' => 'Akuntansi',
            ],
        ];

        foreach ($dataCategory as $key => $value) {
            $value['slug'] = Str::slug($value['name']);
            JobCategory::create($value);
        }
    }
}
