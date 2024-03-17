<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\MovieService;
use App\Http\Requests\MovieRequest\UpdateMovieRequest;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * @var movieService
    */
    private $movieService;


    /**
     * MovieService constructor.
     *
     * @param MovieService $movieService
    */

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * @OA\Get(
     *      path="/api/movie/all",
     *      summary="Get all Star War Movies",
     *      tags={"Star War Movies"},
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          description="Title",
     *          name="search",
     *          example="user",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      description="Returns all or filtered information about the movies",
     *      @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *      @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *      @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *      @OA\Response(response=201, description="Successful created", @OA\JsonContent())
     * )
    */
    public function index(Request $request) : JsonResponse
    {
        return $this->movieService->getAllStarWarMovies($request);
    }

    /**
     * @OA\Get(
     *     path="/api/movie/{id}",
     *     tags={"Star War Movies"},
     *     summary="Get specific star war movie by id ",
     *     security={{"sanctum":{}}},
     *     description="Returns detailed information about the movie",
     *     @OA\Parameter(
     *          name="id",
     *          description="Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *     @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successfull created", @OA\JsonContent()),
     * )
    */
    public function show($id = null) : JsonResponse
    {
        return $this->movieService->getStarWarMovies($id);
    }

    /**
     * @OA\Put(
     *     path="/api/movie/{id}",
     *     tags={"Star War Movies"},
     *     summary="Update specific star war movie by id ",
     *     security={{"sanctum":{}}},
     *     description="Returns information about the specific movie updation",
     *     @OA\Parameter(
     *          name="id",
     *          description="Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\RequestBody(
     *       @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"title", "url", "release_date",
     *                           "backdrop_path", "language", "popularity", "poster_path","video",
     *                           "director", "opening_crawl", "episode_id", "producer","adult",
     *                           "vote_average", "vote_count", "characters"
     *                          },
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="director", type="string"),
     *                 @OA\Property(property="episode_id", type="string"),
     *                 @OA\Property(property="release_date", type="string"),
     *                 @OA\Property(property="producer", type="string"),
     *                 @OA\Property(property="opening_crawl", type="string"),
     *                 @OA\Property(property="adult", type="string"),
     *                 @OA\Property(property="url", type="string"),
     *                 @OA\Property(property="language", type="string"),
     *                 @OA\Property(property="poster_path", type="string"),
     *                 @OA\Property(property="backdrop_path", type="string"),
     *                 @OA\Property(property="video", type="string"),
     *                 @OA\Property(property="vote_average", type="string"),
     *                 @OA\Property(property="popularity", type="string"),
     *                 @OA\Property(property="vote_count", type="string")
     *             )
     *          )
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *     @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successful created", @OA\JsonContent()),
     * )
    */
    public function update(UpdateMovieRequest $request, $id = null): JsonResponse
    {
        return $this->movieService->updateStarWarMovies($request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/movie/{id}",
     *     tags={"Star War Movies"},
     *     summary="Delete specific star war movie by id ",
     *     security={{"sanctum":{}}},
     *     description="Returns information about the specific movie deletion",
     *     @OA\Parameter(
     *          description="Id",
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
     *     @OA\Response(response=400, description="Bad Request", @OA\JsonContent()),
     *     @OA\Response(response=500, description="Server error occured", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successfull created", @OA\JsonContent()),
     * )
    */
    public function delete($id = null) : JsonResponse
    {
        return $this->movieService->deleteStarWarMovies($id);
    }

}
