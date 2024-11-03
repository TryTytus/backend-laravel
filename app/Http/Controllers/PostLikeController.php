<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Response;

class PostLikeController extends Controller
{
    public function like(Post $post)
    {
        $post_like = PostLike::where('post_id', $post->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($post_like)
            return response()->json(['message' => 'already liked'], 400);

        PostLike::create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id
        ]);

        $post->increment('likes_count');

        return response()->noContent();
    }

    public function unlike(Post $post)
    {
        $post_like = PostLike::where('post_id', $post->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$post_like)
            return response()->json(['message' => 'post like not found'], 404);

        $post_like->delete();

        $post->decrement('likes_count');

        return response()->noContent();
    }
}
