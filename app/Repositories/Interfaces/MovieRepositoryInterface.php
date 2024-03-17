<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\MovieRequest\UpdateMovieRequest;
use Illuminate\Http\JsonResponse;

interface MovieRepositoryInterface
{
    public function getStarWarMovies($id): JsonResponse;

    public function getAllStarWarMovies($request): JsonResponse;

    public function updateStarWarMovies(UpdateMovieRequest $request, $id): JsonResponse;
}