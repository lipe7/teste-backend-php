<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Bamaq',
            'email' => 'adm@bamaq.com',
            'cpf' => '123.456.789-00',
            'password' => bcrypt('123456')
        ]);
    }
}
