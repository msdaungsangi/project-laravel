<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'email' => "u1@gmail.com",
            'password' => Hash::make('user1'),
            'name' => "User1",
            'role' => 1,
        ]);

        User::create([
            'email' => "u2@gmail.com",
            'password' => Hash::make('user2'),
            'name' => "Johny Parker",
            'role' => 2,
        ]);

        User::create([
            'email' => "malsawmdaungsangi.cgm@gmail.com",
            'password' => Hash::make('test'),
            'name' => "Daung",
            'role' => 1,
        ]);

        Post::create([
            'title' => "Yoga",
            'description' => "This is good for health and beauty",
            'public_flag' => true,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        Comment::create([
            'user_id' => 1,
            'post_id' => 1,
            'comment' => "This is a comment"
        ]);
    }
}
