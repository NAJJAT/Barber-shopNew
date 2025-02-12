<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment; // Ensure that the Comment class exists in the specified namespace

class FAQCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'faq_categories';


    // Relatie met FAQ's
    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'faq_category_id');
    }
    public function canDelete(User $user, FAQ $faq)
    {
        // Allow if the user is an admin or owns the FAQ
        return $user->is_admin || $user->id === $faq->user_id;
    }
    


    
    
    
        public function canupdate(User $user, FAQ $faq)
    {
        // Admins can update any FAQ, users can only update their own
        return $user->is_admin || $user->id === $faq->user_id;
    }
 
    /**
     * Determine if the user can view the FAQ.
     */
    public function view(User $user, FAQ $faq)
    {
        // All users can view any FAQ
        return true;
    }
    
}
