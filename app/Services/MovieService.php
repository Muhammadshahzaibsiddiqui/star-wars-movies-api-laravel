<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Models\Movie\Movie;
use App\Traits\MovieCachingTrait;

class MovieService implements MovieRepositoryInterface
{

    use MovieCachingTrait;
    /**
     * @var $MovieModel ;
     */
    protected $MovieModel;

    public function __construct()
    {
        $this->MovieModel   = new Movie;
    }

    /**
     * Get all Star War Movies
     * @return JsonResponse
    */
    public function getAllStarWarMovies($request): JsonResponse
    {
        try {
            
            $starWarMovies = $this->getCachedData($request, function () use ($request) {
                return @$request->search ? Movie::where('title', 'LIKE', "%{$request->search}%")->get() : Movie::all();
            });

            return response()->json([
                'status'    => true,
                'message'   => 'Get All Star War Movies Successfully',
                'data'      => $starWarMovies
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Get Specific Star War Movies
     * @return JsonResponse
     */
    public function getStarWarMovies($id): JsonResponse
    {

        try {
            $starWarMovies = $this->MovieModel
                ->with(['Planets', 'Characters'])
                ->where('id', $id)
                ->first();
            return response()->json([
                'status'  => true,
                'message' => 'Get All Star War Movies Successfully',
                'data'    => $starWarMovies
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Delete Specific Star War Movies
     * @return JsonResponse
     */
    public function deleteStarWarMovies($id): JsonResponse
    {
        try
        {
            $isExist =  $this->MovieModel->where('id', $id)->exists();

            if($isExist) {
                $this->MovieModel->where('id', $id)->delete();

                $this->clearAllCachedData();
                
                return response()->json([
                    'status'  => true,
                    'message' => ' successfully deleted ',
                ], 200);
            }
            else{
                return response()->json([
                    'status'  => false,
                    'message' => 'Not Found',
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update Specific Star War Movies
     * @return JsonResponse
     */
    public function updateStarWarMovies($request, $id) : JsonResponse
    {   
        try {
            $updatedStarWarMovies = $this->MovieModel->where('id', $id)->update([
                'title'         => $request->title,
                'episode_id'    => $request->episode_id,
                'opening_crawl' => $request->opening_crawl,
                'director'      => $request->director,
                'producer'      => $request->producer,
                'release_date'  => $request->release_date,
                'url'           => $request->url,
                'language'      => $request->language,
                'backdrop_path' => $request->backdrop_path,
                'popularity'    => $request->popularity,
                'poster_path'   => $request->poster_path,
                'adult'         => $request->adult,
                'vote_average'  => $request->vote_average,
                'vote_count'    => $request->vote_count,
                'video'         => $request->video
            ]);

            $this->clearAllCachedData();

            return response()->json([
                'status'  => true,
                'message' => 'Successfully Updated',
                'data'    => $updatedStarWarMovies
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}