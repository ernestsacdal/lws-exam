<?php

namespace App\Action\Users;

use Illuminate\Support\Facades\Auth;

class UsersLogoutAction
{
    public function execute()
    {
        Auth::user()->currentAccessToken()->delete();

        return true;
    }
}
