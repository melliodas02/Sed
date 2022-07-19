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
            'BirthDay' => '2000-06-14',
            'email' => 'poseydonplay02@gmail.com',
            'password' => bcrypt('Gangsta14@.')
        ]);

        $role = Role::create(['name' => 'Администратор-делопроизводитель']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user = User::create([
            'FirstName' => 'Антон',
            'MiddleName' => 'Васильевич',
            'LastName' => 'Лукьянов',
            'Position' => 'Управляющий',
            'BirthDay' => '1985-04-30',
            'email' => 'alukyanov@domonline.ru',
            'password' => bcrypt('admin')
        ]);
        $user->assignRole([$role->id]);
    }
}
