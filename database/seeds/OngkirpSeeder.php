<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class OngkirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ongkir_p')->insert([

            [
                'nama_kota' => 'Surabaya',
                'harga_ongkir' => '700000'
            ],

            [
                'nama_kota' => 'Jakarta',
                'harga_ongkir' => '2500000'
            ],

            [
                'nama_kota' => 'Mojokerto',
                'harga_ongkir' => '600000'
            ],

            [
                'nama_kota' => 'Probolinggo',
                'harga_ongkir' => '400000'
            ],

            [
                'nama_kota' => 'Pasuruan',
                'harga_ongkir' => '450000'
            ],

            [
                'nama_kota' => 'Cirebon',
                'harga_ongkir' => '1500000'
            ],
        


        ]);
    }
}