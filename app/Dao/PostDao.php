<?php

namespace App\Dao;

use App\Contracts\Dao\PostDaoInterface;
use App\Models\Post;

class PostDao implements PostDaoInterface
{    
    /**
     * getPosts
     *
     * @return object
     */
    public function getPosts(): object
    {
        $posts = Post::orderBy('id')->get();
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
     * @return object
     */
    public function getPostById(int $id): object
    {
        return Post::findOrFail($id);
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
