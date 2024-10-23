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

    public function getAAttribute($value)
    {
        return base64_decode($value);
    }

    public function setAAttribute($value)
    {
        $this->attributes['a'] = base64_encode($value);
    }

    public function getBAttribute($value)
    {
        return base64_decode($value);
    }

    public function setBAttribute($value)
    {
        $this->attributes['b'] = base64_encode($value);
    }

    public function getCAttribute($value)
    {
        return base64_decode($value);
    }

    public function setCAttribute($value)
    {
        $this->attributes['c'] = base64_encode($value);
    }

    public function getDAttribute($value)
    {
        return base64_decode($value);
    }

    public function setDAttribute($value)
    {
        $this->attributes['d'] = base64_encode($value);
    }

    public function getQuestionNameAttribute($value)
    {
        return base64_decode($value);
    }

    public function setQuestionNameAttribute($value)
    {
        $this->attributes['question_name'] = base64_encode($value);
    }

    public function getAnswerAttribute($value)
    {
        return base64_decode($value);
    }

    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = base64_encode($value);
    }
}
