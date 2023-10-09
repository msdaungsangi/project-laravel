<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function getUsers();

    public function createUser(Request $request, array $data);

    public function getUserById(int $id);

    public function updateUser(Request $request, array $data, int $id);

    public function deleteUserById(int $id);

    public function registerUser(Request $request, array $data);
}
