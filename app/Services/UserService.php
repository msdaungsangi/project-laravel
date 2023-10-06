<?php

namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * UserService
 */
class UserService implements UserServiceInterface
{
    /**
     * userDao
     *
     * @var mixed
     */
    private $userDao;

    /**
     * __construct
     *
     * @param  mixed $userDao
     * @return void
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * getUsers
     *
     * @return void
     */
    public function getUsers()
    {
        return $this->userDao->getUsers();
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
        if (Auth::check()) {
            $createdBy = Auth::user()->id;
        }
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

        $data = [
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'img' => $imageName,
            'role' => $data['role'],
            'created_by' => $createdBy,
        ];

        $this->userDao->createUser($request, $data);
    }

    /**
     * getUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function getUserById(int $id)
    {
        return $this->userDao->getUserById($id);
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
        if (Auth::check()) {
            $updatedBy = Auth::user()->id;
        }

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
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'img' => $imageName,
            'role' => $data['role'],
            'updated_by' => $updatedBy,
        ];

        $this->userDao->updateUser($request, $data, $id);
    }

    /**
     * deleteUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUserById(int $id)
    {
        $this->userDao->deleteUserById($id);
    }
}
