<?php

namespace App\Services;

use App\Models\Post;
use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Services\PostServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PostService implements PostServiceInterface
{    
    /**
     * PostDao
     *
     * @var mixed
     */
    protected $PostDao;

    /**
     * __construct
     *
     * @param  mixed $PostDao
     * @return void
     */
    public function __construct(PostDaoInterface $PostDao)
    {
        $this->PostDao = $PostDao;
    }

    /**
     * getPosts
     *
     * @return object
     */
    public function getPosts(): object
    {
        $posts = $this->PostDao->getPosts();
        if (!auth()->check()) {
            $posts = $posts->filter(function ($post) {
                return $post->public_flag == Post::PUBLIC;
            });
            $posts = $posts->map(function ($post) {
                if ($post->public_flag == Post::PUBLIC) {
                    $post->public_flag = 'Public';
                }
                return $post;
            });
        } else {
            $posts = $posts->map(function ($post) {
                if ($post->public_flag == Post::PUBLIC) {
                    $post->public_flag = 'Public';
                } elseif ($post->public_flag == Post::PRIVATE) {
                    $post->public_flag = 'Private';
                }
                return $post;
            });
        }
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
        if (Auth::check()) {
            $createdBy = Auth::user()->id;
        } else {
            $createdBy = null;
        }
        $data = [
            'title' => $data['title'],
            'description' => $data['description'],
            'public_flag' => $data['public_flag'],
            'created_by' => $createdBy,
        ];
        $this->PostDao->createPost($data);
    }

    /**
     * getPostById
     *
     * @param  mixed $id
     * @return object
     */
    public function getPostById(int $id): object
    {
        $post = $this->PostDao->getPostById($id);
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
        if (Auth::check()) {
            $updatedBy = Auth::user()->id;
        } else {
            $updatedBy = null;
        }
        $data = [
            'title' => $data['title'],
            'description' => $data['description'],
            'public_flag' => $data['public_flag'],
            'created_by' => $updatedBy,
        ];
        $this->PostDao->updatePost($data, $id);
    }

    /**
     * deletePostById
     *
     * @param  mixed $id
     * @return void
     */
    public function deletePostById(int $id): void
    {
        $this->PostDao->deletePostById($id);
    }
}
