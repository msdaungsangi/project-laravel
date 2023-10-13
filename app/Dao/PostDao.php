<?php

namespace App\Dao;

use App\Contracts\Dao\PostDaoInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostDao implements PostDaoInterface
{    
    /**
     * getPosts
     *
     * @return \Illuminate\Database\Eloquent\Collection;
     */
    public function getPosts(): Collection
    {
        $posts = Post::with('comments')->get();
        return $posts;
    }
    
    /**
     * createPost
     *
     * @param  mixed $data
     * @return void
     */
    public function createPost(array $data): void
    {
        Post::create($data);
    }
    
    /**
     * getPostById
     *
     * @param  mixed $id
     * @return Post
     */
    public function getPostById(int $id): object
    {
        $post = Post::with('comments')->find($id);
        return $post;
    }
    
    /**
     * updatePost
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updatePost(array $data, int $id): void
    {
        $post = Post::findOrFail($id);
        $post->update($data);
    }
    
    /**
     * deletePostById
     *
     * @param  mixed $id
     * @return void
     */
    public function deletePostById(int $id): void
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }
}
