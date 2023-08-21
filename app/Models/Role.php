<?php
namespace App\Models;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // You might set a public property like guard_name or connection, or override other Eloquent Model methods/properties
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'status',
    //     'email',
    //     'password',
    //     'is_account_enabled'
    // ];
}