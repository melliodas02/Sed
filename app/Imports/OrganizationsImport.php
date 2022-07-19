<?php

namespace App\Imports;

use App\Models\Organization;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class OrganizationsImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        // TODO: Implement model() method.
        return new Organization([
            'INN' => $row[1],
            'OrganizationName' => $row[2]
        ]);
    }
}
