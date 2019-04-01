<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenggunaAuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @group PenggunaAuthenticationTest
     * @return void
     */
    public function visitLoginForm()
    {
        $visitLoginForm = $this
            ->get('/autentikasi/form-login')
            ->assertStatus(200);
    }
}
