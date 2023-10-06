<?php

namespace App\Dao;

use App\Contracts\Dao\LoginDaoInterface;
use Illuminate\Http\Request;

class LoginDao implements LoginDaoInterface
{
    public function updatePassword(Request $request, array $password)
    {
        auth()->user()->update($password);
    }
}
