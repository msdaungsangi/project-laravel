<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PostServiceInterface;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * postService
     *
     * @var mixed
     */
    private $postService;

    /**
     * __construct
     *
     * @param  mixed $postServiceInterface
     * @return void
     */
    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postService = $postServiceInterface;
    }
    
    /**
     * posts
     *
     * @return void
     */
    public function posts()
    {
        $posts = $this->postService->getPosts();

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

        return view('posts.index', compact('posts'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }
    
    /**
     * createPost
     *
     * @param  mixed $request
     * @return void
     */
    public function createPost(PostRequest $request)
    {
        $this->postService->createPost($request->all());
        $success = config('messages.post.success_create');

        return redirect()->route('posts.index')
            ->with('success', $success);
    }
    
    /**
     * detail
     *
     * @param  mixed $id
     * @return void
     */
    public function detail(int $id)
    {
        $post = $this->postService->getPostById($id);
        if ($post->public_flag == Post::PUBLIC) {
            $post->public_flag = 'Public';
        } elseif ($post->public_flag == Post::PRIVATE) {
            $post->public_flag = 'Private';
        }
        return view('posts.detail', compact('post'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(int $id)
    {
        $post = $this->postService->getPostById($id);
        return view('posts.edit', compact('post'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(PostRequest $request, int $id)
    {
        $this->postService->updatePost($request->all(), $id);
        $success = config('messages.post.success_update');

        return redirect()->route('posts.index')
            ->with('success', $success);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $this->postService->deletePostById($id);
        $success = config('messages.post.success_delete');

        return redirect()->route('posts.index')
            ->with('success', $success);
    }
}
