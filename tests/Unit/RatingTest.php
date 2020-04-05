<?php

namespace Tests\Unit;

use App\Models\Rating;
use App\Models\Show;
use App\Models\User;
use Tests\TestCase;

class RatingTest extends TestCase
{
    protected $user;

    protected $shows;

    protected $rating;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->rating = factory(Rating::class)->create();

        $this->shows = factory(Show::class, 10)->create([
            'user_id' => $this->user->id
        ]);

        $this->rating->shows()->saveMany($this->shows);
    }


    /**
     * @test
     */
    public function a_rating_can_have_many_shows()
    {
        $this->assertEquals($this->shows->pluck('id'), $this->rating->shows->pluck('id'));
    }

}
