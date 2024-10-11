<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'naquestion_idme',
        'question_name',
        'contest_id',
        'answer',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
