<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Illuminate\Support\Facades\DB;

class PostsQuery extends Query
{
    protected $attributes = [
        'name' => 'posts',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::nonNull(GraphQL::type('Post')));
    }

    public function args(): array
    {
        return [

        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();


        $posts =Post::with('user')
            ->addSelect(DB::raw('CASE WHEN post_likes IS NULL THEN 0 ELSE 1 END AS liked'))
            ->join('post_likes', 'users.id', '=', 'post_likes.user_id')
            ->orderByDesc('created_at')
            ->paginate(20);

        return $posts;
    }
}
