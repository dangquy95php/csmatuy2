<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Team;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Auth;
use Spatie\Activitylog\Models\Activity;
use Request;
use Browser;

class Gate extends Model
{
    use HasFactory, LogsActivity;

    protected static $recordEvents = ['deleted', 'updated'];
    protected static $logCustomAttributes = [['note'=>'xyz']];

    protected static $logOnlyDirty = true; 

    // protected static $logDescription = 'Cập nhật';

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'staff_out',
        'staff_in',
        'student_out',
        'student_in',
        'note',
        'team_id',
        'count_request',
        'auth_id',
        'gate_note_id',
    ];

    const OUT = 0;
    const IN = 1;
    const ALL = 2;

    const INFOR_GATE = [
        self::ALL => 'Tất cả',
        self::OUT => 'Ra cổng',
        self::IN => 'Vào cổng',
    ];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $object = new \stdClass();
        $object->ip = Request::ip();
        $object->browser = Browser::browserName();
        $object->platform = Browser::platformName();
        $object->device = Browser::deviceType();

        if ($eventName == 'updated') {
            $activity->event = 'Chỉnh sửa';
        } else if ($eventName == 'deleted') {
            $activity->event = 'Xóa';
        }
        
        $activity->browsers = json_encode($object);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('Cổng')
        ->setDescriptionForEvent(function (string $eventName) {
            if ($eventName === 'updated') {
                return 'Cổng được cập nhật bởi ' . Auth::user()->last_name .' '. Auth::user()->first_name;
            } elseif ($eventName === 'deleted') {
                return 'Cổng được xóa bởi ' . Auth::user()->last_name .' '. Auth::user()->first_name;
            }

            return 'Cổng event';
        })->logOnly(['staff_out', 'staff_in', 'student_out', 'student_in', 'note', 'team_id', 'auth_id', 'gate_note_id'])->logOnlyDirty()->dontSubmitEmptyLogs();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(['first_name', 'last_name','status', 'image', 'team_id', 'id']);
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id')->select(['name','id']);
    }

    public function gate_note()
    {
        return $this->belongsTo(GateNote::class, 'gate_note_id', 'id')->select(['name','id']);
    }

    public function auth()
    {
        return $this->belongsTo(User::class, 'auth_id', 'id')->select(['first_name', 'last_name','status', 'image', 'team_id', 'id']);
    }

    public function scopeStartDate($query, $date)
    {
        return $query->whereDate('created_at', '>=', $date);
    }

    public function scopeEndDate($query, $date)
    {
        return $query->whereDate('created_at', '<=', $date);
    }

    public function scopeTypeGate($query, $gate)
    {
        if ($gate == self::ALL) {
            return $query;
        }
        return $query->where('type_gate', $gate);
    }

    public function scopeOrderByID($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }
}