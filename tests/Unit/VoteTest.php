<?php

namespace Tests\Unit;

use App\Models\Reference;
use App\Models\Show;
use App\Models\User;
use App\Models\Vote;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class VoteTest extends TestCase
{
    protected $vote;
    protected $user;
    protected $reference;
    protected $show;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->vote = factory(Vote::class)->create([
            'user_id' => $this->user->id
        ]);
    }

    /**
     * @test
     */
    public function a_vote_has_one_creator()
    {
        $this->assertEquals($this->user->id, $this->vote->voter->id);
    }

    /**
     * @test
     */
    public function a_vote_is_associated_with_one_show()
    {
        $show = factory(Show::class)->create([
            'user_id' => $this->user->id
        ]);

        $show->votes()->save($this->vote); // make the association

        $this->assertEquals($show->id, $this->vote->votable->id); // validate
    }

    /**
     * @test
     */
    public function a_vote_is_associated_with_one_reference()
    {
        $reference = factory(Reference::class)->create([
            'user_id' => $this->user->id
        ]);

        $reference->votes()->save($this->vote); // make the association

        $this->assertEquals($reference->id, $this->vote->votable->id); // validate
    }

}
