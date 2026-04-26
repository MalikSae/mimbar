<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = ['name', 'email', 'password', 'role', 'last_login_at'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['last_login_at' => 'datetime'];

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isPublisher(): bool
    {
        return $this->role === 'publisher';
    }
}
