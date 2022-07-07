<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
			
		[
			'id_kategori' => 1,
        	'nama' => 'PLYWOOD 1',
        	'kategori' => 'PLYWOOD',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '12 x 1220 x 1220 mm',
        	'jml_ukuran' => '17860800',
        	
        	'harga' => '6500000',
            'gambar_produk' => 'plywood.jpg'
        ],

        [
			'id_kategori' => 1,
        	'nama' => 'PLYWOOD 2',
        	'kategori' => 'PLYWOOD',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '9 x 1220 x 1220 mm',
        	'jml_ukuran' => '13395600',
        	
        	'harga' => '6000000',
            'gambar_produk' => 'plywood.jpg'
        ],

        [
			'id_kategori' => 1,
        	'nama' => 'PLYWOOD 3',
        	'kategori' => 'PLYWOOD',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '15 x 1000 x 1500 mm',
        	'jml_ukuran' => '22500000',
        	
        	'harga' => '7000000',
            'gambar_produk' => 'plywood.jpg'
        ],

        [
			'id_kategori' => 1,
        	'nama' => 'PLYWOOD 4',
        	'kategori' => 'PLYWOOD',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '6 x 1220 x 1220 mm',
        	'jml_ukuran' => '8930400',
        	
        	'harga' => '5500000',
            'gambar_produk' => 'plywood.jpg'
        ],

        [
			'id_kategori' => 2,
        	'nama' => 'LVL 1',
        	'kategori' => 'LVL',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '12 x 1220 x 1220 mm',
        	'jml_ukuran' => '17860800',
        	
        	'harga' => '5000000',
            'gambar_produk' => 'LVL.jpg'
        ],

        [
			'id_kategori' => 2,
        	'nama' => 'LVL 2',
        	'kategori' => 'LVL',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '9 x 1220 x 1220 mm',
        	'jml_ukuran' => '13395600',
        	
        	'harga' => '4500000',
            'gambar_produk' => 'LVL.jpg'
        ],

        [
			'id_kategori' => 2,
        	'nama' => 'LVL 3',
        	'kategori' => 'LVL',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '15 x 600 x 2200 mm',
        	'jml_ukuran' => '19800000',
        	
        	'harga' => '5600000',
            'gambar_produk' => 'LVL.jpg'
        ],

        [
			'id_kategori' => 2,
        	'nama' => 'LVL 4',
        	'kategori' => 'LVL',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '9 x 1000 x 1500 mm',
        	'jml_ukuran' => '13500000',
        	
        	'harga' => '4000000',
            'gambar_produk' => 'LVL.jpg'
        ],

        [
			'id_kategori' => 3,
        	'nama' => 'VENEER 1',
        	'kategori' => 'VENEER',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '1,7 x 125 x 125 mm',
        	'jml_ukuran' => '26563',
        	
        	'harga' => '6300000',
            'gambar_produk' => 'veneer.jpg'
        ],

        [
			'id_kategori' => 3,
        	'nama' => 'VENEER 2',
        	'kategori' => 'VENEER',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '2,7 x 125 x 125 mm',
        	'jml_ukuran' => '42188',
        	
        	'harga' => '7000000',
            'gambar_produk' => 'veneer.jpg'
        ],

        [
			'id_kategori' => 3,
        	'nama' => 'VENEER 3',
        	'kategori' => 'VENEER',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '1,5 x 1000 x 1500 mm',
        	'jml_ukuran' => '2250000',
        	
        	'harga' => '6000000',
            'gambar_produk' => 'veneer.jpg'
        ],

        [
			'id_kategori' => 3,
        	'nama' => 'VENEER 4',
        	'kategori' => 'VENEER',
        	'material' => 'Kayu Meranti',
        	'ukuran' => '2,6 x 1000 x 1500 mm',
        	'jml_ukuran' => '3900000',
        	
        	'harga' => '6500000',
            'gambar_produk' => 'veneer.jpg'
		]
        
    
    ]);

        
    }
}
