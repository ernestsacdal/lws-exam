<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\AnimesInterface;
use App\Http\Requests\Animes\CreateAnimeRequest;
use App\Http\Requests\Animes\UpdateAnimeRequest;

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
    public function show($id)
    {
        return $this->repository->show($id);
    }
    public function update(UpdateAnimeRequest $request, $id)
    {
        return $this->repository->update($request, $id);
    }
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
