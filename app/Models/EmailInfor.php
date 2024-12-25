<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\User;

class EmailInfor extends Model
{
    use HasFactory;
 
    const NOT_SEEN = 0;
    const SEEN = 1;

    const NEW = 0;
    const STARRED = 1;
    const TRASH = 2;

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'seen',
        'team_id',
        'user_id',
        'email_id',
        'time_seen',
        'flag'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function email()
    {
        return $this->belongsTo(Email::class, 'email_id', 'id')->with('sub_email_infor');
    }

    public function auth()
    {
        return $this->belongsTo(User::class, 'auth_id', 'id');
    }

}