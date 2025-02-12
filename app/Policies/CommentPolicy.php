<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Comment;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Constructor code here
    }

    public function update(User $user, Comment $comment) {
        return $user->id === $comment->user_id || $user->is_admin;
    }
    
    public function delete(User $user, Comment $comment) {
        return $user->id === $comment->user_id || $user->is_admin;
    }
}
