<?php

namespace App\Imports;

use App\Models\Organization;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        // TODO: Implement model() method.
        return new User([
            'BirthDay' => $row[2]
        ]);
    }
}
