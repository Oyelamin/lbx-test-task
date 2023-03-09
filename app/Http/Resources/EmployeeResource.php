<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $employee = [
            'id' => $this->id,
            'emp_ID' => $this->uid,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_initial' => $this->middle_initial,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'name_prefix' => $this->name_prefix,
            'date_of_birth' => $this->date_of_birth,
            'time_of_birth' => $this->time_of_birth,
            'age_in_yrs' => $this->age_in_yrs,
            'date_of_joining' => $this->date_of_joining,
            'age_in_company' => $this->age_in_company,
            'place_name' => $this->place_name,
            'country' => $this->country,
            'city' => $this->city,
            'zip' => $this->zip,
            'region' => $this->region,
            'created_at' => $this->created_at
        ];

        return $employee;
    }
}
