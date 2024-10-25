<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;
use Auth;
use Browser;
use Request;

class Team extends Model
{
    use HasFactory;
    
    use LogsActivity;

    protected static $recordEvents = ['deleted', 'updated'];

    protected static $logOnlyDirty = true; 

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
        return LogOptions::defaults()->useLogName('Khu/Phòng')
        ->setDescriptionForEvent(function (string $eventName) {
            if ($eventName === 'updated') {
                return 'Khu/Phòng được cập nhật bởi ' . Auth::user()->last_name .' '. Auth::user()->first_name;
            } elseif ($eventName === 'deleted') {
                return 'Khu/Phòng được xóa bởi ' . Auth::user()->last_name .' '. Auth::user()->first_name;
            }

            return 'Khu/Phòng event';
        })->logOnly(['name', 'note', 'type'])->logOnlyDirty()->dontSubmitEmptyLogs();
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $object = new \stdClass();
        $object->ip = Request::ip();
        $object->browser = Browser::browserName();
        $object->platform = Browser::platformName();
        $object->device = Browser::deviceType();

        if ($eventName == 'updated') {
            $activity->event = 'Chỉnh sửa';
        }
        
        $activity->browsers = json_encode($object);
    }
}
