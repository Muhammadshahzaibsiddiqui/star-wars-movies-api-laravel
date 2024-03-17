<?php

namespace App\Traits;
use Illuminate\Support\Facades\Cache;

trait MovieCachingTrait
{
    /**
     * Get the model data from cache or database and cache it.
     *
     * @param  string  $cacheKey
     * @param  \Closure  $getDataFromDatabaseCallback
     * @param  int  $cacheDuration
     * @return mixed
     */
    protected function getCachedData($request, \Closure $getDataFromDatabaseCallback, int $cacheDuration = 3600)
    {   
        $cacheKey = 'movie_data:' . md5(@$request->search ? $request->fullUrl() : $request->url());
        
        // Check if the data is available in the cache.
        if (Cache::has($cacheKey)) {
            // Retrieve the data from the cache.
            return Cache::get($cacheKey);
        }

        // If the data is not in the cache, fetch it from the database using the callback.
        $data = $getDataFromDatabaseCallback();

        // Cache the data for the specified duration (e.g., 1 hour = 3600 seconds).
        Cache::put($cacheKey, $data, $cacheDuration);

        return $data;
    }

     /**
     * Clear the cache for a specific cache key.
     *
     * @param  string  $cacheKey
     * @return void
     */
    protected function clearCachedData(string $cacheKey)
    {
        Cache::forget($cacheKey);
    }

    /**
     * Clear all cached model data.
     *
     * @return void
     */
    protected function clearAllCachedData()
    {
        Cache::flush();
    }
}