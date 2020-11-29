<?php

namespace Tests\Unit;

use App\Models\Theme;
use Tests\TestCase;

class ThemeTest extends TestCase
{

    public function testThemeHasScenes()
    {
        $SCENE_COUNT = 6;

        $theme = Theme::factory()->hasScenes($SCENE_COUNT)->create();

        $this->assertCount($SCENE_COUNT, $theme->scenes);
    }

}
