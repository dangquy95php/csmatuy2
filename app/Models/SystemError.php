<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;

class SystemError extends Model
{
    use HasFactory;
    
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'file',
        'line',
        'code',
    ];
}
