<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PostServiceInterface;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostDeleteRequest;
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
    public function destroy(PostDeleteRequest $request)
    {
        $id = $request->post_id;
        $this->postService->deletePostById($id);
        $success = config('messages.post.success_delete');

        return redirect()->route('posts.index')
            ->with('success', $success);
    }
}
