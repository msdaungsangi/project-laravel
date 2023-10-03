<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * userService
     *
     * @var mixed
     */
    private $userService;

    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userService = $userServiceInterface;
    }

    public function index()
    {
        $users = $this->userService->getUsers();
        $users = $users->map(function ($user) {
            if ($user->role == 1) {
                $user->role = 'admin';
            } elseif ($user->role == 2) {
                $user->role = 'member';
            }
            return $user;
        });

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'email|max:100|unique:users',
            'password' => 'required|max:255',
            'name' => 'required|max:100',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2024',
            'role' => 'required',
        ]);
        $user = $request->all();
        $this->userService->createUser($request, $user);
        $created = config('custom-messages.user.create_success');

        return redirect()->route('users.index')->with('success', $created);
    }

    public function show(int $id)
    {
        $user = $this->userService->getUserById($id);
        if ($user->role == 1) {
            $user->role = 'admin';
        } elseif ($user->role == 2) {
            $user->role = 'member';
        }
        return view('users.show', compact('user'));
    }

    public function edit(int $id)
    {
        $user = $this->userService->getUserById($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'email' => [
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => 'required|max:255',
            'name' => 'required|max:100',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:255',
            'role' => 'required',
        ]);
        $user = $request->all();
        $this->userService->updateUser($request, $user, $id);
        $updated = config('custom-messages.user.update_success');

        return redirect()->route('users.index')
            ->with('success', $updated);
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUserById($id);
        $deleted = config('custom-messages.user.delete_success');

        return redirect()->back()
            ->with('danger', $deleted);
    }
}
