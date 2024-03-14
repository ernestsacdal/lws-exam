<?php
namespace App\Interfaces; 
interface UsersInterface {
    public function store($request);
    public function login($email, $password);
    public function logout();
}
?>