<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpaTest extends TestCase
{
    public function testAnyRouteMatchesSpa()
    {
        $rootResponse = $this->get('/');
        $subUriResponse = $this->get('/some/other/route');

        $rootResponse
            ->assertOk()
            ->assertSee('DOCTYPE html');
        $subUriResponse
            ->assertOk()
            ->assertSee('DOCTYPE html');
    }

    /**
     * HTML index file rendered for SPA
     *
     * @return void
     */
    public function testHtmlIndexRenderable()
    {
        $this->view('welcome')
            ->assertSee('DOCTYPE html'); 
    }
}
