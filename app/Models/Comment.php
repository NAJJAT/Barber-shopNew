<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = ['faq_id', 'user_id', 'content'];


    public function faq() {
        return $this->belongsTo(FAQ::class);
    }


     // Relationship with User
     public function user()
     {
         return $this->belongsTo(User::class);
     }
    
    
    
}
