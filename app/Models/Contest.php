<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Contest extends Model
{
    use HasFactory;

    protected $table = 'contests';
    
    const DISABLE = 0;
    const ENABLE = 1;

    const INFOR_STATUS = [
        self::ENABLE => 'Đang mở',
        self::DISABLE => 'Đã đóng',
    ];

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'status',
        'time_test'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
