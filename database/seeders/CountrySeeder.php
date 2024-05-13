<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $useStates = [
            "AL" => 'Alabama',
            "Ak" => 'Alaska',
            "AZ" => 'Arizona',
            "AR" => 'Arkansas',
            "CA" => 'California',
        ];

        $countries = [
            ['code' => 'geo', 'name' => 'Georgia', 'states' => null],
            ['code' => 'ing', 'name' => 'India', 'states' => null],
            ['code' => 'usa', 'name' => 'Uniteed States ofAmerica', 'states' => json_encode($useStates)],
            ['code' => 'get', 'name' => 'Germany', 'states' => null],
        ];

        Country::insert($countries);

    }
}
