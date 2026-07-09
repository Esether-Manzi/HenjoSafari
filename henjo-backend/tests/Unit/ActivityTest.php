<?php

namespace Tests\Unit;

use App\Models\Activity;
use Spatie\MediaLibrary\HasMedia;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    public function test_activity_implements_has_media_interface(): void
    {
        $activity = new Activity();

        $this->assertInstanceOf(HasMedia::class, $activity);
    }
}
