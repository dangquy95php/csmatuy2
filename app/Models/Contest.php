<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Auth;
use Browser;
use Request;

class Contest extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'contests';
    
    protected static $recordEvents = ['updated'];

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
        'time_test',
        'link'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('Cuộc thi')
        ->setDescriptionForEvent(function (string $eventName) {
            if ($eventName === 'updated') {
                return 'Cập nhật bởi ' . Auth::user()->last_name .' '. Auth::user()->first_name;
            }
            return 'Cuộc thi event';
        })->logOnly(['name', 'status', 'time_test', 'user_id'])->logOnlyDirty()->dontSubmitEmptyLogs();
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
