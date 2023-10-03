<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface UserDaoInterface
{
    public function getUsers();

    public function createUser(Request $request, array $data);

    public function getUserById(int $id);

    public function updateUser(Request $request, array $data, int $id);

    public function deleteUserById(int $id);
}
