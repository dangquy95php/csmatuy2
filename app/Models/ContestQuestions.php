<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestQuestions extends Model
{
    use HasFactory;

    protected $table = 'contest_questions';

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];
}
