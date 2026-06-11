<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
