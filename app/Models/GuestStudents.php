<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestStudents extends Model
{
    use HasFactory;

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'staff_name',
        'number_of_drug_addicts',
        'type_gate',
        'car_number',
        'time',
        'note',
    ];
}
