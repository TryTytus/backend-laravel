<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    public function modify(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

}
