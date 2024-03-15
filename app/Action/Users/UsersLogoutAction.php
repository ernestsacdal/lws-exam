<?php

namespace App\Action\Users;

use Illuminate\Support\Facades\Auth;

class UsersLogoutAction
{
    //deletes the current access token for the authenticated user
    public function execute()
    {
        Auth::user()->currentAccessToken()->delete();

        return true;
    }
}
