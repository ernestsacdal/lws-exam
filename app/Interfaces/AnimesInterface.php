<?php

namespace App\Interfaces;

interface AnimesInterface
{
    public function store($request);
    public function list();
    public function show($id);
}
