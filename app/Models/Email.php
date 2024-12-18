<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eamil;
use App\Models\Team;
use App\Models\User;

class Email extends Model
{
    use HasFactory;
 
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'seen',
        'team_id',
        'auth_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function auth()
    {
        return $this->belongsTo(User::class);
    }
}