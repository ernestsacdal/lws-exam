<?php
namespace App\Action\Users;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersCreateAction
{
    public function execute($request)
    {
        $data = $request->validated(); 

        $dataSet = [
            'firstName' => $data['firstName'],
            'middleName' => $data['middleName'] ?? null, 
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'contactNumber' => $data['contactNumber'],
            'birthday' => $data['birthday'],
            'password' => Hash::make($data['password']), 
        ];

        $user = User::create($dataSet);

        return $user;
    }
}
?>