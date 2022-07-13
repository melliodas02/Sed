<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'FirstName' => 'Ансар',
            'MiddleName' => 'Айнурович',
            'LastName' => 'Юлчурин',
            'Position' => 'Программист',
            'email' => 'poseydonplay02@gmail.com',
            'password' => bcrypt('Gangsta14@.')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user = User::create([
            'FirstName' => 'Антон',
            'MiddleName' => 'Васильевич',
            'LastName' => 'Лукьянов',
            'Position' => 'Управляющий',
            'email' => 'alukyanov@domonline.ru',
            'password' => bcrypt('admin')
        ]);
        $user->assignRole([$role->id]);
    }
}
