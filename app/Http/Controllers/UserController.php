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

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = $request->all();
        $this->userService->createUser($request, $user);

        return redirect()->route('users.index')
            ->with('success', 'User Created successfully.');
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $request->all();
        $this->userService->updateUser($request, $user, $id);

        return redirect()->route('users.index')
            ->with('success', 'User Updated successfully.');
    }

    public function destroy($id)
    {
        $this->userService->deleteUserById($id);

        return redirect()->back()
            ->with('danger', 'User deleted successfully.');

    }
}
