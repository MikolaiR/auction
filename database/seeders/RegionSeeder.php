<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            'Брестская область',
            'Витебская область',
            'Гомельская область',
            'Гродненская область',
            'Минская область',
            'Могилевская область',
            'Минск',
        ];

        foreach ($regions as $region) {
            Region::factory()->create([
                'name' => $region,
            ]);
        }
    }
}
