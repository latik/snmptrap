<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SiteTest extends TestCase
{
    use WithoutMiddleware, DatabaseMigrations;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_home_page()
    {
        $this->visit('/')
            ->see('Мониторинг');
    }
}
