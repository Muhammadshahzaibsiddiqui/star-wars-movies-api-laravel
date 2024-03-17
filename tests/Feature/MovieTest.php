<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Movie\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;

class MovieTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        // $this->seed();
    }

    private function authenticateUser()
    {
        $user  = User::factory()->create(['password' => 'secret']); // Create and authenticate a user
        Auth::attempt(['email' => $user->email, 'password' => 'secret']);
        $token = Auth::user()->createToken('TEST TOKEN')->accessToken->token;
        return ['Authorization' => "Bearer $token"];
    }

    public function testMovieIndex()
    {
        $headers = $this->authenticateUser();

        $this->json('GET', route('movie.index'), [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'status',
                'message'
            ]);
    }

    public function testMovieShow()
    {
        $headers = $this->authenticateUser();

        $movie = Movie::factory()->create();
        $response = $this->json('GET', route('movie.show', $movie->id), [], $headers);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => $movie->title,
                ],
            ]);

        $movie->delete();
    }

    public function testMovieUpdate()
    {
        $headers = $this->authenticateUser();

        $movie = Movie::factory()->create();

        $updatedTitle = 'New Move Jedia Updated';
        $movie->title = $updatedTitle;

        $response = $this->json('PUT', route('movie.update', $movie->id), [
            'title'         => $movie->title,
            'episode_id'    => $movie->episode_id,
            'opening_crawl' => $movie->opening_crawl,
            'director'      => $movie->director,
            'producer'      => $movie->producer,
            'release_date'  => $movie->release_date->format('Y-m-d'),
            'url'           => $movie->url,
            'language'      => $movie->language,
            'backdrop_path' => $movie->backdrop_path,
            'popularity'    => $movie->popularity,
            'poster_path'   => $movie->poster_path,
            'adult'         => $movie->adult,
            'vote_average'  => $movie->vote_average,
            'vote_count'    => $movie->vote_count,
            'video'         => $movie->video
        ], $headers);

        $response->assertStatus(200);

        $movie->delete();
    }

    public function testMovieDelete()
    {
        $headers = $this->authenticateUser();

        $movie = Movie::factory()->create();

        $response = $this->json('DELETE', route('movie.delete', $movie->id), [], $headers);

        $response->assertStatus(200);
        $this->assertEquals(0, Movie::where('id', $movie->id)->count());
    }
}
