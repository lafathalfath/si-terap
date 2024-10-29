<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = storage_path('/app/data_region/provinces.csv');
        $csv_file = fopen($file_path, 'r');
        $bypass = fgetcsv($csv_file); // bypass first row
        
        $provinsi = [];
        while (($row = fgetcsv($csv_file)) !== false) {
            $provinsi[] = [
                'id' => $row[0],
                'name' => $row[1],
            ];
        }
        fclose($csv_file);

        DB::table('m_provinsi')->insert($provinsi);
    }
}