<?php

namespace Tests\Unit;

use App\Models\Format;
use Tests\TestCase;

class FormatTest extends TestCase
{

    public function testFormatHasPages ()
    {
        $PAGE_COUNT = 6;

        $format = Format::factory()->hasPages($PAGE_COUNT)->create();

        $this->assertCount($PAGE_COUNT, $format->pages);
    }

}
