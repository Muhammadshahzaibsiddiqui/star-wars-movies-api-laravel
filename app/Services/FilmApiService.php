<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FilmApiService
{
    public function getFilmApiData($request)
    {

        $cacheKey = 'film_api_data:' . md5(@$request->search ? $request->fullUrl() : $request->url());
        $cacheTime = now()->addMinutes(env('FILM_API_DATA_CHACHE_DURATION', 60));

        // Check if the response is already cached
        if (Cache::has($cacheKey)) {
            $response = Cache::get($cacheKey);
        } else {
            // Make the API request to fetch the data
            $response = Http::get(env('FILM_API_URL', 'https://swapi.dev/api/films'));

            $response = $response->json();

            // Store the response in the cache for the configured time
            Cache::put($cacheKey, $response, $cacheTime);
        }

        return $response;

    }
}
