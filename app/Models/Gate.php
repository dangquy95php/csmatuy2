<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Team;

class Gate extends Model
{
    use HasFactory;

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
    
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name','status', 'image', 'team_id', 'id']);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'department', 'id')->select(['name','id']);
    }
}