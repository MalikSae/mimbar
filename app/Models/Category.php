<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'name_ar', 'slug', 'type', 'description'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function donationPrograms()
    {
        return $this->hasMany(DonationProgram::class, 'category_id');
    }
}
