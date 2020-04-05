<?php

namespace Tests\Unit;

use App\Models\Genre;
use App\Models\Show;
use App\Models\User;
use Tests\TestCase;

class GenreTest extends TestCase
{
    protected $user;

    protected $shows;

    protected $genre;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->genre = factory(Genre::class)->create();

        $this->shows = factory(Show::class, 10)->create([
            'user_id' => $this->user->id
        ]);

        $this->genre->shows()->saveMany($this->shows);
    }


    /**
     * @test
     */
    public function a_genre_can_have_many_shows()
    {
        $this->assertEquals($this->shows->pluck('id'), $this->genre->shows->pluck('id'));
    }

}
