<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\UserServiceInterface;
use App\Models\User;

class UserControl
{
    /**
     * userService
     *
     * @var mixed
     */
    protected $userService;

    /**
     * __construct
     *
     * @param  mixed $userService
     * @return void
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
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
        $user = $this->userService->getUserById($request->id);
        if (Auth::user()->id == $user->id || Auth::user()->role == User::ADMIN_ROLE) {
            return $next($request);
        } else {
            return response(view('403'));
        }
    }
}
