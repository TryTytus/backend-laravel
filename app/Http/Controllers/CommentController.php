<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller implements HasMiddleware
{
    public function index()
    {
        return Comment::with('user')
            ->orderByDesc('likes_count')
            ->paginate(20);
    }


    public function store(CommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        Comment::create($data);

        return response('created', 201);
    }

    public function show(int $comment)
    {
        return Comment::with('user')->findOrFail($comment);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        Gate::authorize('modify', $comment);

        $data = $request->validated();
        $comment->update($data);
    }


    public function destroy(Comment $comment)
    {
        Gate::authorize('modify', $comment);

        $comment->delete();
    }


    public static function middleware() : array
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
}
