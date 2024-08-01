<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Team extends Model
{
    use HasFactory;
    
    use LogsActivity;

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'note',
        'type',
    ];

    const PLEASE_CHOOSE_HOUR = 0;
    const NO_OFFICE_HOUR = 1;
    const OFFICE_HOUR = 2;

    const WORK_HOUR = [
        self::PLEASE_CHOOSE_HOUR => 'Vui lòng chọn loại hình làm việc',
        self::NO_OFFICE_HOUR => 'Không làm việc giờ hành chính',
        self::OFFICE_HOUR => 'Làm việc giờ hành chính',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'note', 'created_at']);
    }
}
