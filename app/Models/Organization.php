<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrganizationName',
        'OrganizationAbbreviatedName',
        'OrganizationAddress',
        'PositionAtWork',
        'FirstName',
        'MiddleName',
        'LastName',
        'Phone',
        'Email',
        'Fax'
    ];
}
