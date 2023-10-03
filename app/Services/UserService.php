<?php

namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Http\Request;

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
