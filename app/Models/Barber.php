<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'photo',
        'bio',
        'available',
        // Add other barber-specific fields as needed
    ];
}
