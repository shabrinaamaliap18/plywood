<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(CategoriSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OngkirSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        
    }
}
