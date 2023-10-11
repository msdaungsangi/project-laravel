<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\PostServiceInterface;

class OwnData
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
            return response(view('403'));
        } else {
            if (Auth::user()->role == 2) {
                $post = $this->postService->getPostById($request->id);
                if (Auth::user()->id == $post->created_by) {
                    return $next($request);
                } else {
                    return response(view('403'));
                }
            } else if (Auth::user()->role == 1) {
                return $next($request);
            } else {
                return response(view('403'));
            }
        }
    }
}
