<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'FirstMame' => 'Ансар',
            'MiddleName' => 'Айнурович',
            'LastName' => 'Юлчурин',
            'Position' => 'Программист',
            'email' => 'poseydonplay02@gmail.com',
            'password' => bcrypt('Gangsta14@.')
        ];

        DB::table('users')->insert([
            'FirstName' => 'Ансар',
            'MiddleName' => 'Айнурович',
            'LastName' => 'Юлчурин',
            'Position' => 'Программист',
            'email' => 'poseydonplay02@gmail.com',
            'password' => bcrypt('Gangsta14@.')
        ]);

        DB::table('users')->insert([
            'FirstName' => 'Лукьянов',
            'MiddleName' => 'Антон',
            'LastName' => 'Васильевич',
            'Position' => 'Управляющий',
            'email' => 'alukyanov@domonline.ru',
            'password' => bcrypt('admin')
        ]);
    }
}
