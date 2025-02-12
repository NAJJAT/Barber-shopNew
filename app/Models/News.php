<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;



    protected $table = 'news'; // Ensure it matches your table name

    protected $fillable = [
        'title',
        'content',
        'image_url',
        'published_at',
    ];
    protected $casts = [
        'published_at' => 'datetime', // Ensure published_at is treated as a Carbon instance
    ];
}
