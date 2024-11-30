<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Define the relationship with Role (Override)
    public function role()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }
    // Define the relationship with Permissions
    public function allPermissions()
    {
        return $this->role->flatMap->permissions;
    }
}