<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawQuestions extends Model
{
    use HasFactory;

    protected $table = 'law_questions';

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'contest_id',
        'question_name',
        'a',
        'b',
        'c',
        'd',
        'random',
        'point',
        'answer',
    ];
}
