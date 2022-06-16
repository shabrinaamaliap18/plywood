<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;


class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'nama_kategori' => 'Plywood',
                'keterangan_kategori' => 'Kayu lapis atau sering disebut tripleks adalah sejenis papan pabrikan yang terdiri dari lapisan kayu yang direkatkan bersama-sama.',
                'stok' => '100',
                'foto_kategori' => 'plywood.jpg',
            ],

            [
                'nama_kategori' => 'LVL',
                'keterangan_kategori' => 'Kayu veneer laminasi adalah produk kayu rekayasa yang menggunakan beberapa lapisan kayu tipis yang dirakit dengan perekat.',
                'stok' => '100',
                'foto_kategori' => 'LVL.jpg',
            ],
            
            [
                'nama_kategori' => 'Veneer',
                'keterangan_kategori' => 'Venir kayu atau venir adalah lembaran tipis kayu, biasanya lebih tipis daripada 3 mm, yang dihasilkan dengan mengiris balok kayu.',
                'stok' => '100',
                'foto_kategori' => 'veneer.jpg',
            ]

            
        ]);
    }
}