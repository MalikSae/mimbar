<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Author extends Authenticatable
{
    protected $table = 'authors';

    protected $fillable = ['name', 'email', 'password', 'is_active', 'avatar', 'bio'];


    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['is_active' => 'boolean'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }
}
