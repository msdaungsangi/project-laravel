<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\PostServiceInterface;

class Detail
{
    protected $postService;
    
    /**
     * __construct
     *
     * @param  mixed $postService
     * @return void
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            $post = $this->postService->getPostById($request->id);
            if ($post && $post->public_flag === 'Public') {
                return $next($request);
            }
            return response(view('403'));
        } else {
            return $next($request);
        }
    }
}
