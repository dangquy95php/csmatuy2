<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eamil;
use App\Models\Team;
use App\Models\User;
use App\Models\EmailInfor;

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
        'auth_id',
        'file'
    ];

    public function auth()
    {
        return $this->belongsTo(User::class);
    }

    public function email_infor()
    {
        return $this->hasOne(EmailInfor::class);
    }
    
    public function sub_email_infor()
    {
        return $this->hasMany(EmailInfor::class, 'email_id', 'id')->with(['user', 'team']);
    }
}