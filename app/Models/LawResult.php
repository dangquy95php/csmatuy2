<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawResult extends Model
{
    use HasFactory;

    protected $table = 'law_results';

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'time_start',
        'time_end',
        'forecast',
    ];
}