<?php

namespace App\Services;

use App\Contracts\Dao\LoginDaoInterface;
use App\Contracts\Services\LoginServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * LoginService
 */
class LoginService implements LoginServiceInterface
{
    /**
     * loginDao
     *
     * @var mixed
     */
    protected $loginDao;

    /**
     * __construct
     *
     * @param  mixed $loginDao
     * @return void
     */
    public function __construct(LoginDaoInterface $loginDao)
    {
        $this->loginDao = $loginDao;
    }

    /**
     * updatePassword
     *
     * @param  mixed $request
     * @param  mixed $password
     * @return void
     */
    public function updatePassword(Request $request, array $password)
    {
        $password = [
            'password' => Hash::make($password['new_password']),
        ];

        return $this->loginDao->updatePassword($request, $password);
    }
}
