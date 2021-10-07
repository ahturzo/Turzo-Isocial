<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'banner', 'body', 'category_id', 'tag'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
