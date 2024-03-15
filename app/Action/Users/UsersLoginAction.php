<?php

namespace App\Action\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersLoginAction
{
    //Attempts to log a user in with the provided credentials.
    public function execute($email, $password)
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return ['error' => 'The provided credentials are incorrect.', 'user' => null, 'token' => null];
        }
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;
        return ['error' => null, 'user' => $user, 'token' => $token];
    }
}
