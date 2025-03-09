<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = storage_path('app/sample-data/states.csv');

        $country = DB::table('countries')->where('iso_3166_2', 'us')->first();
        if (! $country) {
            return;
        }
        DB::table('states')->where('country_id', $country ? $country->id : null)->delete();
        $states  = [];
        
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Skip the header row
            fgetcsv($handle);
            
            while (($data = fgetcsv($handle)) !== false) {
                $states[] = [
                    'state' => $data[0],
                    'abbreviation' => $data[1],
                    'latitude' => $data[2],
                    'longitude' => $data[3],
                    'city' => $data[4],
                    'zip_code' => $data[5],
                    'county' => $data[6],
                    'zip_code_pattern' => $data[7],
                ];
            }
            fclose($handle);
        }

        $states = collect($states)->map(function ($state) use ($country) {
            return [
                'country_id' => $country->id,
                'state' => $state['state'],
                'tax_rate' => 9.48,
                'city' => $state['city'],
                'county' => $state['county'],
                'zip_code' => $state['zip_code'],
                'latitude' => $state['latitude'],
                'longitude' => $state['longitude'],
                'zip_code_pattern' => $state['zip_code_pattern'],
                'delivery_fee' => 10,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        DB::table('states')->insert($states);
    }
}
