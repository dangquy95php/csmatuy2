<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'activity_log';

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'event',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'batch_uuid',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
