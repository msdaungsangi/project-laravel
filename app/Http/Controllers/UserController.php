<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    /**
     * userService
     *
     * @var mixed
     */
    private $userService;
    
    /**
     * __construct
     *
     * @param  mixed $userServiceInterface
     * @return void
     */
    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userService = $userServiceInterface;
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $users = $this->userService->getUsers();
        $users = $users->map(function ($user) {
            if ($user->role == User::ADMIN_ROLE) {
                $user->role = 'Admin';
            } elseif ($user->role == User::MEMBER_ROLE) {
                $user->role = 'Member';
            }
            return $user;
        });

        return view('users.index', compact('users'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('users.create');
    }

    public function registUser(Request $request)
    {
        $request->validate([
            'email' => 'email|max:100|unique:users',
            'password' => 'required|max:255',
            'name' => 'required|max:100',
        ]);
        $user = $request->all();
        $this->userService->registerUser($request, $user);
        $created = config('messages.user.create_success');
        return redirect()->route('auth.login')->with('success', $created);
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
        $created = config('messages.user.create_success');

        return redirect()->route('users.index')->with('success', $created);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show(int $id)
    {
        $user = $this->userService->getUserById($id);
        if ($user->role == User::ADMIN_ROLE) {
            $user->role = 'Admin';
        } elseif ($user->role == User::MEMBER_ROLE) {
            $user->role = 'Member';
        }
        return view('users.show', compact('user'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(int $id)
    {
        $user = $this->userService->getUserById($id);

        return view('users.edit', compact('user'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
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
        $updated = config('messages.user.update_success');

        return redirect()->route('users.index')
            ->with('success', $updated);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy(int $id)
    {
        $this->userService->deleteUserById($id);
        $deleted = config('messages.user.delete_success');

        return redirect()->back()
            ->with('danger', $deleted);
    }
}
