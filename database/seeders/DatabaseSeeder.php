<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//        foreach (range(1, 20) as $i)
//        {
//            User::factory()->create();
//        }


//        foreach (range(1, 40) as $i)
//        {
//            Post::factory()->create();
//        }


        foreach (range(1, 50) as $i)
        {
            Comment::factory()->create();
        }

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

//        User::factory(10)->create();


    }
}
