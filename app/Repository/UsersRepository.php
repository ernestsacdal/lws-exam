<?php

namespace App\Repository;

use App\Interfaces\UsersInterface;
use App\Action\Users\UsersCreateAction;
use App\Action\Users\UsersLoginAction;
use Illuminate\Http\Response;

class UsersRepository implements UsersInterface {
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
}
?>