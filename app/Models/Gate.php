<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Team;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Gate extends Model
{
    use HasFactory;

    use LogsActivity;

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'number_of_drug_addicts',
        'note',
        'type_gate',
        'user_id',
        'department',
        'count_request',
    ];
    
    const OUT = 0;
    const IN = 1;
    const ALL = 2;

    const INFOR_GATE = [
        self::ALL => 'Tất cả',
        self::OUT => 'Ra cổng',
        self::IN => 'Vào cổng',
    ];



    public function user()
    {
        return $this->belongsTo(User::class)->select(['name','status', 'image', 'team_id', 'id']);
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class, 'department', 'id')->select(['name','id']);
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['user_id', 'number_of_drug_addicts', 'note', 'type_gate', 'department', 'created_at']);
    }
}