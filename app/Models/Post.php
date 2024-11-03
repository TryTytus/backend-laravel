<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;
    protected $fillable = ['title', 'content', 'user_id', ''];


    public function ownedBy($userId = null)
    {
        $userId = $userId ?: auth()->id();

        return $this->user_id === $userId;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function like()
    {
        return $this->hasOne(PostLike::class);
    }

//    public function likes()
//    {
//        return $this->hasMany(CommentLike::class);
//    }
}
