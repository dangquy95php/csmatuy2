<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Team;

class LogPassword extends Model
{
    use HasFactory;

    protected $table = 'log_pass';

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'password',
    ];

    public function getPasswordAttribute($value)
    {
        return base64_decode($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = base64_encode($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
