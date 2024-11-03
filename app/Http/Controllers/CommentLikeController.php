<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Post;

class CommentLikeController extends Controller
{
    public function like(Comment $comment)
    {
        $comment_like = CommentLike::where('post_id', $comment->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($comment_like)
            return response()->json(['message' => 'already liked'], 400);

        CommentLike::create([
            'post_id' => $comment->id,
            'user_id' => auth()->user()->id
        ]);

        $comment->increment('likes_count');

        return response()->noContent();
    }

    public function unlike(Comment $comment)
    {
        $post_like = CommentLike::where('post_id', $comment->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$post_like)
            return response()->json(['message' => 'post like not found'], 404);

        $post_like->delete();

        $comment->decrement('likes_count');

        return response()->noContent();
    }
}
