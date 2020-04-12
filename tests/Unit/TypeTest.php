<?php

namespace Tests\Unit;

use App\Models\Reference;
use App\Models\Type;
use Tests\TestCase;

class TypeTest extends TestCase
{
    protected $type;

    public function setUp(): void
    {
        parent::setUp();

        $this->type = factory(Type::class)->create();
    }

    /**
     * @test
     */
    public function a_type_can_have_many_references() // a_cinematic_term_can_have_many_breakdowns
    {
        $references = factory(Reference::class, 10)->create();

        $this->type->references()->saveMany($references);

        $this->assertEquals($references->pluck('id'), $this->type->references->pluck('id'));
    }
}
