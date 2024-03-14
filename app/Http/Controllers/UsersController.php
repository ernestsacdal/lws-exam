<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\UsersInterface;
use App\Http\Requests\Users\CreateUserRequest;

class UsersController extends Controller
{
    private UsersInterface $repository;

    public function __construct(UsersInterface $repository){
        $this->repository = $repository;
    }

    public function store(CreateUserRequest $request)
    {
      return $this->repository->store($request);
    }

    public function login(Request $request)
    {
    return $this->repository->login($request->email, $request->password);
    }
    public function logout(Request $request)
    {
        return $this->repository->logout();
    }
}
