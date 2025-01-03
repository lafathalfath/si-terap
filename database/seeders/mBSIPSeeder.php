<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mBSIPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = storage_path('/app/data_region/bsip.csv');
        $csv_file = fopen($file_path, 'r');
        $header = fgetcsv($csv_file); // bypass first row

        $bsip = [];
        while (($row = fgetcsv($csv_file)) !== false) {
            $bsip[] = [
                'id' => $row[0],
                'provinsi_id' => $row[1],
                'name' => $row[2],
                'alamat' => $row[3],
            ];
        }
        fclose($csv_file);

        DB::table('m_bsip')->insert($bsip);
    }
}
