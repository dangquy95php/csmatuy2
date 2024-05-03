<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Team extends Model
{
    use HasFactory;

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'note',
    ];

    public function user()
    {
        return $this->hasMany(User::class, );
    }
}
