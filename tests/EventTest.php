<?php

use App\Events\LinkChangeTrap;
use App\Trap;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EventTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *
     * @return void
     */
    public function test_event_firing_with_trap_mock()
    {
        $trap = Mockery::mock(Trap::class)->makePartial();
        $trap->status = 'down';

        Event::shouldReceive('fire')->once()->with(LinkChangeTrap::class);

        Event::fire(new LinkChangeTrap($trap));
    }

    public function test_event_firing_with_event_mock()
    {
        $event = Mockery::mock(LinkChangeTrap::class)->makePartial();

        Event::shouldReceive('fire')->once()->with(LinkChangeTrap::class);

        Event::fire($event);
    }
}
