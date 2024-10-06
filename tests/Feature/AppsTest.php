<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example_test_pest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('login');
    }
}
