<?php

namespace App\Dao;

use App\Contracts\Dao\LoginDaoInterface;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * LoginDao
 */
class LoginDao implements LoginDaoInterface
{    
    /**
     * updatePassword
     *
     * @param  mixed $request
     * @param  mixed $password
     * @return void
     */
    public function updatePassword(Request $request, array $password)
    {
        auth()->user()->update($password);
    }
}
