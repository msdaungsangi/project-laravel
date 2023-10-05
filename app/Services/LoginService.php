<?php

namespace App\Services;

use App\Models\User;
use App\Contracts\Dao\LoginDaoInterface;
use App\Contracts\Services\LoginServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginServiceInterface
{   
    protected $loginDao;
    
    public function __construct(LoginDaoInterface $loginDao)
    {
        $this->loginDao = $loginDao;
    }


}

