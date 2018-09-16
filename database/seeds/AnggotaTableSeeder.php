<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anggota')->insert([
        	'group_id' => 'G'.rand(0000,9999),
        	'anggota_id' => 'superadmin',
        	'name' => 'superadmin',
        	'email' => 'su@gmail.com',
        	'password' => Hash::make('su123'),
        	'posisi' => 'superadmin',
        	'role' => 'superadmin'
        ]);
    }
}
