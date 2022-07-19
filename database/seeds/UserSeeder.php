<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;




class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->delete();
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'lokasi' => 'Surabaya',
            'alamat' => 'Jl Kahuyungan no 103',
            'nohp' => '0892828123',
            'role' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'nama_perusahaan' => 'PT Gatra Mapan',
            'name' => 'Imel',
            'email' => 'i@gmail.com',
            'lokasi' => 'Mojokerto',
            'alamat' => 'Jl Semeru no 103',
            'nohp' => '0892828128',
            'role' => 'customer',
            'password' => bcrypt('12345678'),

        ]);

        $user->assignRole('user');
    }
}
