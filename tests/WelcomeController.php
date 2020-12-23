<?php

namespace Tests;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeController extends TestCase
{
    use InteractsWithAuthentication;
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_redirects_to_login_page_if_not_authenticated()
    {
        $response = $this->get(route('root'));

        $response->assertStatus(200);

        $response->assertViewIs('auth.login');
    }

    /**
     * @test
     */
    public function it_redirects_to_app_index_if_authenticated()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get(route('root'));

        $response->assertStatus(200);

        $response->assertViewIs('dashboard');
    }
}
