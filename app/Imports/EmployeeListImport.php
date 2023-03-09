<?php

namespace App\Imports;

use App\Models\Employee;
use App\Support\Traits\HelperTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \Carbon\Carbon;

class EmployeeListImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{

    use HelperTrait;

    public function model(array $row): ?Model
    {
        $data = [
            "uid" => self::cleanupUid(@$row['emp_id']),
            'name_prefix' => @$row['name_prefix'],
            'first_name' => @$row['first_name'],
            'last_name' => @$row['last_name'],
            'username' => @$row['user_name'],
            'middle_initial' => @$row['middle_initial'],
            'gender' => @$row['gender'],
            'email' => @$row['e_mail'],
            'date_of_birth' => self::cleanupDateString(@$row['date_of_birth']), // Reformat the date and clean up
            'time_of_birth' => @$row['time_of_birth'],
            'age_in_yrs' => @$row['age_in_yrs'],
            'date_of_joining' => self::cleanupDateString(@$row['date_of_joining']),
            'age_in_company' => is_numeric(@$row['age_in_company_years']) ? @$row['age_in_company_years'] : 0,
            'phone' => @$row['phone_no'],
            'place_name' => @$row['place_name'],
            'country' => @$row['county'],
            'city' => @$row['city'],
            'zip' => is_numeric(@$row['zip']) ? @$row['zip'] : 0,
            'region' => @$row['region']
        ];

        return Employee::updateOrCreate([
            'uid' => $data['uid'] // Uniqueness
        ], [...$data]);

    }

    public function chunkSize(): int
    {
        return 1000;
    }


}
