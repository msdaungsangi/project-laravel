<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\CommentServiceInterface;
use App\Models\User;

class CommentControl
{
    protected $commentService;

    /**
     * __construct
     *
     * @param  mixed $postService
     * @return void
     */
    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
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
        }
        $comment = $this->commentService->getCommentById($request->id);
        if (Auth::user()->id == $comment->user_id || Auth::user()->role == User::ADMIN_ROLE) {
            return $next($request);
        } else {
            return response(view('403'));
        }
    }
}
