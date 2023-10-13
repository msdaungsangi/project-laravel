<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * UserDao
 */
class UserDao implements UserDaoInterface
{
    /**
     * getUsers
     *
     * @return void
     */
    public function getUsers()
    {
        $users = User::orderBy('id')->get();
        return $users;
    }
        
    /**
     * registerUser
     *
     * @param  mixed $request
     * @param  mixed $data
     * @return void
     */
    public function registerUser(Request $request, array $data)
    {
        User::create($data);
    }

    /**
     * createUser
     *
     * @param  mixed $request
     * @param  mixed $data
     * @return void
     */
    public function createUser(Request $request, array $data)
    {
        User::create($data);
    }

    /**
     * getUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function getUserById(int $id)
    {
        $user = User::with('posts')->find($id);
        if ($user->role == User::ADMIN_ROLE) {
            $user->role = 'Admin';
        } elseif ($user->role == User::MEMBER_ROLE) {
            $user->role = 'Member';
        }
        return $user;
    }

    /**
     * updateUser
     *
     * @param  mixed $request
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateUser(Request $request, array $data, int $id)
    {
        $user = User::findOrFail($id);
        $user->update($data);
    }

    /**
     * deleteUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUserById(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
