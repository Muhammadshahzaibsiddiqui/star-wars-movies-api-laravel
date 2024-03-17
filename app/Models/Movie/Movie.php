<?php

namespace App\Models\Movie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'overview',
        'url',
        'language',
        'popularity',
        'poster_path',
        'release_date',
        'video',
        'vote_average',
        'vote_count',
        'episode_id',
        'opening_crawl',
        'director',
        'producer',
        'adult',
        'backdrop_path'
    ];

     /**
     * Characters
     *
     * @return hasMany
     */
    public function characters()
    {
        return $this->hasMany(Character::class, 'movie_id');
    }

    /**
     * planets
     *
     * @return hasMany
     */
    public function planets()
    {
        return $this->hasMany(Planet::class, 'movie_id');
    }
}
