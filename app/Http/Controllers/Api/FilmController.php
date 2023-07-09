<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Services\FilmApiService;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FilmController extends Controller
{
    
    protected $filmApiService;

    public function __construct(FilmApiService $filmApiService)
    {
        $this->filmApiService = $filmApiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = @$request->search ? trim($request->search) : Null;

        $data = $this->filmApiService->getFilmApiData($request);

        $this->store($data); 
        
        $films = Film::query();
          
        if($search){
            $films = $films->where('title', 'LIKE', "%{$search}%");
        }

        $films = $films->get();
       
        return response()->json($films);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($data)
    {
        if(@$data['results'] && count($data['results']) > 0){
            
            $filmsData = $data['results'];
            
            foreach ($filmsData as $filmData) {

                $created = Carbon::parse($filmData['created'])->toDateTimeString();
                $edited = Carbon::parse($filmData['edited'])->toDateTimeString();
                
                $film = [
                    'title'             => $filmData['title'],
                    'episode_id'        => $filmData['episode_id'],
                    'opening_crawl'     => $filmData['opening_crawl'],
                    'director'          => $filmData['director'],
                    'producer'          => $filmData['producer'],
                    'release_date'      => $filmData['release_date'],
                    'film_created_at'   => $created,
                    'film_edited_at'    => $edited,
                ];

                Film::updateOrCreate(
                    [
                        'title'         => $filmData['title'], 
                        'episode_id'    => $filmData['episode_id'], 
                        'director'      => $filmData['director'],
                        'producer'      => $filmData['producer']
                    ],
                    $film
                );
                
            }

            return true;
        }

        return false;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        try {
            $film = Film::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Film not found'], 404);
        }

        try {
            
            // Validate the request data
            $validatedData = $request->validate([
                'title'         => 'sometimes|string|max:255',
                'episode_id'    => 'sometimes|integer',
                'director'      => 'sometimes|string|max:255',
                'producer'      => 'sometimes|string|max:255',
                'opening_crawl' => 'sometimes',
                'release_date'  => 'sometimes|date',
            ]);

        } catch (ValidationException $exception) {
            return response()->json(['errors' => $exception->errors()], 422);
        }

        // Update the movie with the validated data
        $film->update($validatedData);

        return response()->json(['message' => 'Film updated successfully' , 'data' => $film]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $movie = Film::findOrFail($id);
            
            // Perform soft delete
            $movie->delete();

            return response()->json(['message' => 'Movie deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
    }
}
