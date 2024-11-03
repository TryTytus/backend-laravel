<?php

namespace App\Policies;

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookmarkPolicy
{

    public function bookmark_delete(User $user, Bookmark $bookmark): bool
    {
        return $user->id === $bookmark->user_id;
    }

}
