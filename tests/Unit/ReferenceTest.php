<?php

namespace Tests\Unit;

use App\Models\Reference;
use App\Models\Show;
use App\Models\Type;
use App\Models\User;
use App\Models\Vote;
use Tests\TestCase;

class ReferenceTest extends TestCase
{
    protected $user;

    protected $reference;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->reference = factory(Reference::class)->create([
            'user_id' => $this->user->id
        ]);
    }


    /**
     * @test
     */
    public function a_reference_can_have_many_votes()
    {
        $votes = factory(Vote::class, 10)->make([
            'user_id' => $this->user->id
        ])->each(function($vote) {
            /** @var Vote $vote */

            $vote->votable()->associate(
                $this->reference
            )->save();

        });

        $voteReferenceCount = $votes
            ->where('votable_type', get_class($this->reference))
            ->where('votable_id', $this->reference->id)->count();

        $referenceVoteCount = $this->reference->votes->count();

        $this->assertEquals($voteReferenceCount, $referenceVoteCount);
    }

    /**
     * @test
     */
    public function a_reference_can_have_many_types()
    {
        $types = factory(Type::class, 10)->create();

        $this->reference->types()->saveMany($types);

        $this->assertEquals($types->pluck('id'), $this->reference->types->pluck('id'));
    }

    /**
     * @test
     */
    public function a_reference_can_have_many_shows()
    {
        $shows = factory(Show::class, 10)->create([
            'user_id' => $this->user->id
        ]);

        $this->reference->shows()->saveMany($shows);

        $this->assertEquals($shows->pluck('id'), $this->reference->shows->pluck('id'));
    }

    /**
     * @test
     */
    public function a_reference_has_just_one_creator()
    {
        $this->assertEquals($this->user->id, $this->reference->creator->id);
    }

}
