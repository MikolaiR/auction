<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtlasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $atlases = [
            [
                'iso2' => 'BY',
                'iso3' => 'BLR',
                'name' => 'Беларусь',
                'phone_code' => '375',
                'capital' => 'Минск',
                'currency' => 'бел.р.',
                'currency_symbol' => 'Br',
                'currency_code' => 'BYN',
                'emoji' => 'bel',
                'states' => [
                    'Минск',
                    'Брестская область',
                    'Витебская область',
                    'Гомельская область',
                    'Гродненская область',
                    'Минская область',
                    'Могилевская область',
                ]
            ],
            [
                'iso2' => 'RU',
                'iso3' => 'RUS',
                'name' => 'Россия',
                'phone_code' => '7',
                'capital' => 'Москва',
                'currency' => 'р.',
                'currency_symbol' => '₽',
                'currency_code' => 'RUB',
                'emoji' => 'rus',
                'states' => [
                ]
            ],
            [
                'iso2' => 'KZ',
                'iso3' => 'KZ',
                'name' => 'Казахстан',
                'phone_code' => 'KZ',
                'capital' => 'KZ',
                'currency' => 'KZ',
                'currency_symbol' => 'KZ',
                'currency_code' => 'KZ',
                'emoji' => 'KZ',
                'states' => [
                ]
            ],
            [
                'iso2' => 'UZ',
                'iso3' => 'UZ',
                'name' => 'Узбекистан',
                'phone_code' => 'UZ',
                'capital' => 'UZ',
                'currency' => 'UZ',
                'currency_symbol' => 'UZ',
                'currency_code' => 'UZ',
                'emoji' => 'UZ',
                'states' => [
                ]
            ],
            [
                'iso2' => 'TJ',
                'iso3' => 'TJ',
                'name' => 'Таджикистан',
                'phone_code' => 'TJ',
                'capital' => 'TJ',
                'currency' => 'TJ',
                'currency_symbol' => 'TJ',
                'currency_code' => 'TJ',
                'emoji' => 'TJ',
                'states' => [
                ]
            ],
        ];
        foreach ($atlases as $atlas) {
            $country = Country::create([
                'iso2' => $atlas['iso2'],
                'iso3' => $atlas['iso3'],
                'name' => $atlas['name'],
                'phone_code' => $atlas['phone_code'],
                'capital' => $atlas['capital'],
                'currency' => $atlas['currency'],
                'currency_symbol' => $atlas['currency_symbol'],
                'currency_code' => $atlas['currency_code'],
                'emoji' => $atlas['emoji'],
            ]);
            foreach ($atlas['states'] as $key => $state) {
                State::create([
                    'country_id' => $country->id,
                    'name' => $state,
                    'code' => $key,
                ]);
            }
        }
//        // Insert countries into the database
//        $this->command->info('Seeding countries...');
//        $countries_sql = file_get_contents(database_path('dump/countries.sql'));
//        DB::unprepared($countries_sql);
//        $this->command->info('Seeding countries completed.');
//
//        // Insert timezones into the database
//        $this->command->info('Seeding timezones...');
//        $timezones_sql = file_get_contents(database_path('dump/timezones.sql'));
//        DB::unprepared($timezones_sql);
//        $this->command->info('Seeding timezones completed.');
//
//        // Insert states into the database
//        $this->command->info('Seeding states...');
//        $states_sql = file_get_contents(database_path('dump/states.sql'));
//        DB::unprepared($states_sql);
//        $this->command->info('Seeding states completed.');
//
//        // Insert cities into the database
//        $this->command->info('Seeding cities...');
//        $cities_sql = file_get_contents(database_path('dump/cities.sql'));
//        DB::unprepared($cities_sql);
//        $this->command->info('Seeding cities completed.');
    }
}
