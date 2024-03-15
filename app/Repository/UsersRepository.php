<?php

namespace App\Repository;

use App\Interfaces\UsersInterface;
use App\Action\Users\UsersCreateAction;
use App\Action\Users\UsersLoginAction;
use App\Action\Users\UsersLogoutAction;
use Illuminate\Http\Response;

class UsersRepository implements UsersInterface {
    //Stores a new user record in the database and generates an authentication token.
    public function store($request) {
        try {
            $action = new UsersCreateAction();
            $user = $action->execute($request);
            $user->makeHidden(['password', 'remember_token']);
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'message' => 'User created successfully.',
                'token' => $token,
                'data' => $user,
                'status' => Response::HTTP_CREATED
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create the user.',
                'error' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }   
    }

    //Handles the user login process.
    public function login($email, $password)
    {
        $action = new UsersLoginAction();
        $result = $action->execute($email, $password);

        if ($result['error']) {
            return response()->json([
                'message' => $result['error'],
                'status' => Response::HTTP_UNAUTHORIZED
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'message' => 'Login successful.',
            'data' => [
                'token' => $result['token'],
            ],
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
    
    //Handles the user logout process.
    public function logout()
    {
        $action = new UsersLogoutAction();
        $result = $action->execute();
    
        if ($result) {
            return response()->json([
                'message' => 'Logged out successfully',
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
    
        return response()->json([
            'message' => 'Unauthorized - No active session or token found',
            'status' => Response::HTTP_UNAUTHORIZED
        ], Response::HTTP_UNAUTHORIZED);
    }

    
}
?>