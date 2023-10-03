<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

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
        $users = User::orderBy('name')->get();
        return $users;
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
        $request->validate([
            'email' => 'email|max:100|unique:users',
            'password' => 'required|max:255',
            'name' => 'required|max:100',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2024',
            'role' => 'required',
        ]);

        if ($request->file('img')) {
            $imageName = time() . '.' . $request->file('img')->getClientOriginalExtension();
            $folder = 'public/images';

            if (!File::isDirectory($folder)) {
                File::makeDirectory($folder, 0755, true, true);
            }
            $request->file('img')->storeAs($folder, $imageName);
        } else {
            $imageName = null;
        }

        User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'img' => $imageName,
            'role' => $data['role'],
        ]);
    }
    
    /**
     * getUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function getUserById($id)
    {
        return User::findOrFail($id);
    }
    
    /**
     * updateUser
     *
     * @param  mixed $request
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateUser(Request $request, array $data, $id)
    {
        $user = User::findOrFail($id);
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
        if ($request->file('img')) {
            $imageName = time() . '.' . $request->file('img')->getClientOriginalExtension();
            $folder = 'public/images';

            if (!File::isDirectory($folder)) {
                File::makeDirectory($folder, 0755, true, true);
            }
            $request->file('img')->storeAs($folder, $imageName);
        } else {
            $imageName = null;
        }
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'img' => $imageName,
            'role' => $data['role'],
        ]);
    }
    
    /**
     * deleteUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUserById($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
