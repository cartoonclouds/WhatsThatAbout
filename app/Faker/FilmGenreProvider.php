<?php


namespace App\Faker;

use Faker\Provider\Base;

class FilmGenreProvider extends Base
{
    protected static $filmGenres = [
        'Action',
        'Adventure',
        'Animation',
        'Anime',
        'Biography',
        'Comedy',
        'Crime',
        'Documentary',
        'Drama',
        'Family',
        'Fantasy',
        'Film-Noir',
        'Game Show',
        'History',
        'Horror',
        'Live-Action Scripted',
        'Live-Action Unscripted',
        'Music',
        'Musical',
        'Mystery',
        'News',
        'Philosophical',
        'Political',
        'Reality-TV',
        'Romance',
        'Romance',
        'Sci-Fi',
        'Short Film',
        'Sport',
        'Superhero',
        'Talk Show',
        'Thriller',
        'War',
        'Western',
    ];

    public function genre(): string
    {
        return static::randomElement(static::$filmGenres);
    }
}
