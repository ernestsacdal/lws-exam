<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\AnimesInterface;
use App\Http\Requests\Animes\CreateAnimeRequest;

class AnimesController extends Controller
{
    private AnimesInterface $repository;

    public function __construct(AnimesInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(CreateAnimeRequest $request)
    {
        return $this->repository->store($request);
    }
    public function list()
    {
        return $this->repository->list();
    }
}
