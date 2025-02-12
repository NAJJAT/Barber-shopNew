<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'name',           // Name of the service
        'description',    // Description of the service
        'price',          // Price of the service
        // '_token' is not typically included in models, it’s used for CSRF protection in forms
    ];
}
