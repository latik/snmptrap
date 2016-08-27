<?php

use App\Point;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PointTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Point
     */
    protected $point;

    /**
     * @var \Mockery\Mock
     */
    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->point = Point::create([
            'ip' => '127.0.0.1',
            'port' => '9999',
            'status' => 'up',
        ]);

        $this->mock = Mockery::mock(Point::class)->makePartial();
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     *
     * @return void
     */
    public function test_status()
    {
        $this->assertEquals('up', $this->point->getAttribute('status'));
    }

    public function test_attribute()
    {
        $this->mock->shouldReceive('getAttribute')->with('status')->andReturn('unknown');

        $this->assertEquals('unknown', $this->mock->getAttribute('status'));
    }

    public function test_attribute_mutations_with_mock()
    {
        $this->mock->shouldReceive('setAttribute')->with('status', 'down');
        $this->mock->shouldReceive('save')->andReturn(true);
        $this->mock->shouldReceive('getAttribute')->with('status')->andReturn('down');

        $this->mock->setAttribute('status', 'down');
        $this->assertTrue($this->mock->save());
        $this->assertEquals('down', $this->mock->getAttribute('status'));
    }

    public function test_events_on_mutation()
    {
        Event::shouldReceive('fire')->twice()->withArgs(['point.updated', Mockery::any()]);

        $this->point->setAttribute('status', 'up');
        $this->assertTrue($this->point->save());
        $this->assertEquals('up', $this->point->getAttribute('status'));

        $this->point->setAttribute('status', 'down');
        $this->assertTrue($this->point->save());
        $this->assertEquals('down', $this->point->getAttribute('status'));

        $this->point->setAttribute('status', 'up');
        $this->assertTrue($this->point->save());
        $this->assertEquals('up', $this->point->getAttribute('status'));
    }
}
