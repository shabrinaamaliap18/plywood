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
        DB::table('ongkirs')->insert([

            [
                'nama_kota' => 'Surabaya',
                'alat_angkut' => 'Truck Kun',
                'harga_ongkir' => '1200000'
            ],
            [
                'nama_kota' => 'Surabaya',
                'alat_angkut' => 'Pickup',
                'harga_ongkir' => '1200000'
            ],

            [
                'nama_kota' => 'Jakarta',
                'alat_angkut' => 'Truck Kun',
                'harga_ongkir' => '4600000'
            ],
            [
                'nama_kota' => 'Jakarta',
                'alat_angkut' => 'Pickup',
                'harga_ongkir' => '4600000'
            ],

            [
                'nama_kota' => 'Mojokerto',
                'alat_angkut' => 'Truck Kun',
                'harga_ongkir' => '1000000'
            ],
            [
                'nama_kota' => 'Mojokerto',
                'alat_angkut' => 'Pickup',
                'harga_ongkir' => '1000000'
            ],

            [
                'nama_kota' => 'Probolinggo',
                'alat_angkut' => 'Truck Kun',
                'harga_ongkir' => '700000'
            ],
            [
                'nama_kota' => 'Probolinggo',
                'alat_angkut' => 'Pickup',
                'harga_ongkir' => '700000'
            ],

            [
                'nama_kota' => 'Pasuruan',
                'alat_angkut' => 'Truck Kun',
                'harga_ongkir' => '800000'
            ],
            [
                'nama_kota' => 'Pasuruan',
                'alat_angkut' => 'Pickup',
                'harga_ongkir' => '800000'
            ],

            [
                'nama_kota' => 'Cirebon',
                'alat_angkut' => 'Truck Kun',
                'harga_ongkir' => '3500000'
            ],
            [
                'nama_kota' => 'Cirebon',
                'alat_angkut' => 'Pickup',
                'harga_ongkir' => '3500000'
            ],



        ]);
    }
}
