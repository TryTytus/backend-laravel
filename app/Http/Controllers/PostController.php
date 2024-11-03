<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function index()
    {
        if (!auth('sanctum')->check())
            return Post::with('user')
                ->orderByDesc('created_at')
                ->paginate(20);


        return Post::with('user')->

        with('like', function (HasOne $q) {
            $q->where('user_id', auth('sanctum')->user()->id);
        })
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function store(PostRequest $request)
    {
        $data = [
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ];

        return Post::create($data);
    }


    public function show(int $post)
    {
        $post = Post::with('user')
            ->findOrFail($post);
        $post->increment('views_count');

        return $post;
    }

    public function update(PostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);

        $post->update($request->only('content'));
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();
    }

}
