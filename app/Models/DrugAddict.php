<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugAddict extends Model
{
    use HasFactory;
    
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'personal_name',
        'note',
        'type_gate',
        'name_of_addict',
        'kind_of_detox',
        'car_number',
        'name_of_drug_addict'
    ];
}
