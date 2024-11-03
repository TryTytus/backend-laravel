<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookmarkRequest;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class BookmarkController extends Controller
{
    public function index(User $user)
    {
        return $user->bookmarks();
    }

    public function store(BookmarkRequest $request)
    {
        Bookmark::create([
            'user_id' => $request->user()->id,
            'book_id' => $request->input('book_id'),
        ]);
    }

    public function destroy(Bookmark $bookmark)
    {
        Gate::authorize('bookmark_delete', $bookmark);

        $bookmark->delete();
    }
}
