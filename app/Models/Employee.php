<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';

    protected $fillable = [
        'uid',
        'username',
        'first_name',
        'last_name',
        'middle_initial',
        'email',
        'phone',
        'gender',
        'name_prefix',
        'date_of_birth',
        'time_of_birth',
        'age_in_yrs',
        'date_of_joining',
        'age_in_company',
        'place_name',
        'country',
        'city',
        'zip',
        'region'
    ];


}
