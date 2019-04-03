<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([[
          'name' => "Admin",
          'email' => "admin@admin.com",
          'password' => Hash::make("admin"),
          'akses' => "Admin Gudang"
        ],[
          'name' => "Super Admin",
          'email' => "superadmin@admin.com",
          'password' => Hash::make("admin"),
          'akses' => "Admin Utama"
        ]]);
      DB::table('kategoris')->insert([[
          'nama' => "Food Product"
        ],[
          'nama' => "General Merchandise Product"
        ],[
          'nama' => "Perishable"]]);
      DB::table('units')->insert([[
          'nama' => "Kg"
        ],[
          'nama' => "Kodi"
        ],[
          'nama' => "Pcs"]]);
    }
}
