<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
            ],
            'content' => [
                'name' => 'content',
                'type' => Type::nonNull(Type::string()),
            ],
            'likes_count' => [
                'name' => 'likes_count',
                'type' => Type::nonNull(Type::int()),
            ],
            'views_count' => [
                'name' => 'views_count',
                'type' => Type::nonNull(Type::int()),
            ],
            'comments_count' => [
                'name' => 'comments_count',
                'type' => Type::nonNull(Type::int()),
            ],
            'created_at' => [
                'name' => 'created_at',
                'type' => Type::nonNull(Type::string()),
            ],
            'updated_at' => [
                'name' => 'updated_at',
                'type' => Type::nonNull(Type::string()),
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::int()),
            ],
            'user' => [
                'name' => 'user',
                'type' => GraphQL::type('User'),
            ],
            'liked' => [
                'name' => 'liked',
                'type' => Type::boolean(),
            ]
        ];
    }
}
