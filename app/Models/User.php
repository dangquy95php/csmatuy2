<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Hash;
use Auth;
use App\Models\Answer;
use App\Models\Team;
use App\Models\Permit;
use App\Models\UserInfor;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected static $recordEvents = ['deleted', 'updated'];
    
    use LogsActivity;

    const NOT_ACTIVATED = 0;
    const ENABLE = 1;
    const DISABLE = 2;

    const INFOR_STATUS = [
        self::NOT_ACTIVATED => 'Chưa kích hoạt',
        self::ENABLE => 'Đang hoạt động',
        self::DISABLE => 'Ngừng hoạt động',
    ];

    const TYPE_ACCOUNT_VC_NLD = 1;
    const TYPE_ACCOUNT_OTHER = 0;

    const TYPE_ACCOUNT = [
        self::TYPE_ACCOUNT_VC_NLD => 'Tài khoản VC-NLĐ',
        self::TYPE_ACCOUNT_OTHER => 'Tài khoản riêng',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'status',
        'email',
        'password',
        'is_account_enabled',
        'team_id',
        'image',
        'level',
        'flag_change_pass'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['first_name', 'last_name', 'email', 'image', 'status', 'team_id'])->logOnlyDirty()->dontSubmitEmptyLogs();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user_infor()
    {
        return $this->hasOne(UserInfor::class);
    }

    public function getFullNameAttribute()
    {
        return $this->last_name.' '.$this->first_name;
    }
}