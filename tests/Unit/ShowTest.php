<?php

namespace Tests\Unit;

use App\Models\Genre;
use App\Models\Rating;
use App\Models\Reference;
use App\Models\Show;
use App\Models\User;
use App\Models\Vote;
use Tests\TestCase;

class ShowTest extends TestCase
{
    protected $show;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->show = factory(Show::class)->create([
            'user_id' => $this->user->id
        ]);
    }

    /**
     * @test
     */
    public function a_show_can_have_many_votes()
    {
        $votes = factory(Vote::class, 10)->make([
            'user_id' => $this->user->id
        ])->each(function($vote) {
            /** @var Vote $vote */

            $vote->votable()->associate(
                $this->show
            )->save();

        });

        $voteShowCount = $votes
            ->where('votable_type', get_class($this->show))
            ->where('votable_id', $this->show->id)->count();

        $showVoteCount = $this->show->votes->count();

        $this->assertEquals($voteShowCount, $showVoteCount);
    }

    /**
     * @test
     */
    public function a_show_can_have_many_references()
    {
        $references = factory(Reference::class, 10)->create([
            'user_id' => $this->user->id
        ]);

        $this->show->references()->saveMany($references);

        $this->assertEquals($references->pluck('id'), $this->show->reference->id);
    }

    /**
     * @test
     */
    public function a_show_can_have_many_ratings()
    {
        $ratings = factory(Rating::class, 10)->create();

        $this->show->ratings()->saveMany($ratings);

        $this->assertEquals($ratings->pluck('id'), $this->show->ratings->pluck('id'));
    }

    /**
     * @test
     */
    public function a_show_can_have_many_genres()
    {
        $genres = factory(Genre::class, 10)->create();

        $this->show->genres()->saveMany($genres);

        $this->assertEquals($genres->pluck('id'), $this->show->genres->pluck('id'));
    }

    /**
     * @test
     */
    public function a_show_has_just_one_creator()
    {
        $this->assertEquals($this->user->id, $this->show->creator->id);
    }

}
