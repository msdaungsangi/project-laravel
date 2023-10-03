<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface UserServiceInterface
{
    /**
     * getUsers
     *
     * @return void
     */
    public function getUsers();

    /**
     * createUser
     *
     * @param  mixed $data
     * @return void
     */
    public function createUser(Request $request, array $data);

    /**
     * getUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function getUserById(int $id);

    /**
     * updateUser
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateUser(Request $request, array $data, int $id);

    /**
     * deleteUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUserById(int $id);
}
