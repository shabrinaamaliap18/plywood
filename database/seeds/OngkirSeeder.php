<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class OngkirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ongkir')->insert([

            [
                'nama_kota' => 'Surabaya',
                'harga_ongkir' => '1200000'
            ],

            [
                'nama_kota' => 'Jakarta',
                'harga_ongkir' => '4600000'
            ],

            [
                'nama_kota' => 'Mojokerto',
                'harga_ongkir' => '1000000'
            ],

            [
                'nama_kota' => 'Probolinggo',
                'harga_ongkir' => '700000'
            ],

            [
                'nama_kota' => 'Pasuruan',
                'harga_ongkir' => '800000'
            ],
        


        ]);
    }
}