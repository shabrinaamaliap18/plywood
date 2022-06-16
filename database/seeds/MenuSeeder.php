<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([

            [
                'nama_menu' => 'Manajemen Menu',
                'level_menu' => 'main_menu',
                'url' => 'menu',
                'icon' => 'far fa-file-alt',
                'aktif' => 'Y',
                'no_urut' => 1,
                'master_menu' => 0,
            ],

            [
                'nama_menu' => 'Manajemen Pesanan',
                'level_menu' => 'sub_menu',
                'url' => 'pesanan',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 2,
                'master_menu' => 1,
            ],

            [
                'nama_menu' => 'Manajemen Kategori',
                'level_menu' => 'sub_menu',
                'url' => 'categories',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 3,
                'master_menu' => 1,
            ],

            [
                'nama_menu' => 'Manajemen Material',
                'level_menu' => 'sub_menu',
                'url' => 'material',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 4,
                'master_menu' => 1,
            ],

            [
                'nama_menu' => 'Manajemen User',
                'level_menu' => 'sub_menu',
                'url' => 'user',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 5,
                'master_menu' => 1,
            ],

            [
                'nama_menu' => 'Manajemen Produk',
                'level_menu' => 'sub_menu',
                'url' => 'produk',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 6,
                'master_menu' => 1,
            ],

            [
                'nama_menu' => 'Manajemen Custom',
                'level_menu' => 'sub_menu',
                'url' => 'customm',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 7,
                'master_menu' => 1,
            ],

            [
                'nama_menu' => 'Manajemen Lokasi',
                'level_menu' => 'sub_menu',
                'url' => 'lokasi',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 8,
                'master_menu' => 1,
            ],

            [
                'nama_menu' => 'Rekap Laporan',
                'level_menu' => 'sub_menu',
                'url' => 'rekap',
                'icon' => '',
                'aktif' => 'Y',
                'no_urut' => 9,
                'master_menu' => 1,
            ],


            


            


        ]);
    }
}
