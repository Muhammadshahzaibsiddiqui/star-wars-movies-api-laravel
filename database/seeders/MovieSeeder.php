<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie\Movie;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make the API request to fetch the data
        $swapiResponse = Http::get(env('SWAPI_MOVIE_API_URL', 'https://swapi.dev/api/films'));
        $swapiResponse = $swapiResponse->json();
        $swapiResponse = @$swapiResponse['results'] ? $swapiResponse['results'] : [];

        foreach ($swapiResponse as $row) {

            // Define the query parameters as an array.
            $searchTitle = $row['title'];
            $queryParams = [
                'query'     => $searchTitle,
                'api_key'   => env('TMDB_API_KEY', "9ac1ed5b7761ca8946f97c71f7a7fcc3"),
            ];

            $imdbResponse = [];
            $imdbResponse = Http::get(env('TMDB_MOVIE_API_URL', 'https://api.themoviedb.org/3/search/movie'), $queryParams);
            $imdbResponse = $imdbResponse->json();
            $imdbResponse = @$imdbResponse['results'] ? $imdbResponse['results'] : [];

            $filteredImdbMovies = array_filter($imdbResponse, function ($movie) use ($searchTitle) {
                return $movie['original_title'] === $searchTitle;
            });

            $filteredImdbMovies = count($filteredImdbMovies) > 0 ? @$filteredImdbMovies[0] : [];

            $created = Carbon::parse($row['created'])->toDateTimeString();
            $edited = Carbon::parse($row['edited'])->toDateTimeString();
            
            $movie = Movie::create([
                'title'             => $row['title'],
                'episode_id'        => $row['episode_id'],
                'opening_crawl'     => $row['opening_crawl'],
                'director'          => $row['director'],
                'producer'          => $row['producer'],
                'release_date'      => $row['release_date'],
                'url'               => $row['url'],
                'movie_created_at'  => $created,
                'movie_edited_at'   => $edited,
                'adult'             => @$filteredImdbMovies['adult'],
                'backdrop_path'     => @$filteredImdbMovies['backdrop_path'],
                'language'          => @$filteredImdbMovies['original_language'],
                'popularity'        => @$filteredImdbMovies['popularity'],
                'poster_path'       => @$filteredImdbMovies['poster_path'],
                'video'             => @$filteredImdbMovies['video'],
                'vote_average'      => @$filteredImdbMovies['vote_average'],
                'vote_count'        => @$filteredImdbMovies['vote_count']
            ]);

            foreach ($row['characters'] as $url) {
                $movie->characters()->create(['movie_id' => $movie->id, 'url' => $url]);
            }

            foreach ($row['planets'] as $url) {
                $movie->planets()->create(['movie_id' => $movie->id, 'url' => $url]);
            }

        }
    }
}
