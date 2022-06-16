<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;


class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('material')->insert([
            [
                'nama_material' => 'Kayu Meranti',
                'stok_material' => '1000',
                'foto_material' => 'triplek.jpg',
            ],
        


        ]);
    }
}