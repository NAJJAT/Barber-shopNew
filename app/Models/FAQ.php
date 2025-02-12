<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = ['faq_category_id', 'question', 'answer', 'user_id'];
    
    // Relatie met categorieën
    public function category()
    {
        return $this->belongsTo(FAQCategory::class, 'faq_category_id');
    }

    // Relationship with Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}