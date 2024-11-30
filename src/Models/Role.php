<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Define the relationship with User (Override)
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    // Define the relationship with Permissions (Override)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
