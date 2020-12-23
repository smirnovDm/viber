<?php

namespace Tests\Feature\Patterns;
use App\Models\Messages\Pattern;
use App\Models\Roles\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatternsController extends TestCase
{
    use RefreshDatabase;
    use InteractsWithAuthentication;

    /**
     * @test
     */
    public function route_index_requires_authentication()
    {
        $this->get(route('sms-patterns.index'))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_create_requires_authentication()
    {
        $this->get(route('sms-patterns.create'))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_show_requires_authentication()
    {
        $pattern = Pattern::factory()->create();

        $this->get(route('sms-patterns.show', $pattern->id))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_store_requires_authentication()
    {
        $this->post(route('sms-patterns.store'))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_index_allowed_only_for_admins()
    {
        $user = User::factory()->create([
            'role_id' => Role::ADMIN
        ]);

        $this->actingAs($user)
            ->get(route('sms-patterns.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function route_index_not_allowed_for_operators()
    {
        $user = User::factory()->create([
            'role_id' => Role::OPERATOR
        ]);

        $this->actingAs($user)
            ->get(route('sms-patterns.index'))
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function route_create_allowed_only_for_admins()
    {
        $user = User::factory()->create([
            'role_id' => Role::ADMIN
        ]);

        $this->actingAs($user)
            ->get(route('sms-patterns.create'))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function route_create_not_allowed_for_operators()
    {
        $user = User::factory()->create([
            'role_id' => Role::OPERATOR
        ]);

        $this->actingAs($user)
            ->get(route('sms-patterns.create'))
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function route_show_allowed_only_for_admins()
    {
        $user = User::factory()->create([
            'role_id' => Role::ADMIN
        ]);

        $pattern = Pattern::factory()->create();

        $this->actingAs($user)
            ->get(route('sms-patterns.show', $pattern->id))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function route_show_not_allowed_for_operators()
    {
        $user = User::factory()->create([
            'role_id' => Role::OPERATOR
        ]);

        $pattern = Pattern::factory()->create();

        $this->actingAs($user)
            ->get(route('sms-patterns.show', $pattern->id))
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function only_admins_can_store_patterns()
    {
        $user = User::factory()->create([
            'role_id' => Role::ADMIN
        ]);

        $attrs = [
            'theme'      => 'sdfsdffgdsf',
            'tag'        => 'dskjfhgjsdhfgkjsdhf',
            'viber_text' => 'sdlfkjsoifjgsdfgdsfgds',
            'sms_text'   => 'sdfoidsfgiodssdfsdf',
        ];

        $response = $this->actingAs($user)
            ->post(route('sms-patterns.store'), $attrs);

        $this->assertDatabaseHas('patterns', [
            'theme'      => 'sdfsdffgdsf',
            'tag'        => 'dskjfhgjsdhfgkjsdhf',
            'viber_text' => 'sdlfkjsoifjgsdfgdsfgds',
            'sms_text'   => 'sdfoidsfgiodssdfsdf',
            'user_id'    => $user->id,
        ]);

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function operators_cannot_store_patterns()
    {
        $user = User::factory()->create([
            'role_id' => Role::OPERATOR
        ]);

        $attrs = [
            'theme'      => 'sdfsdffgdsf',
            'tag'        => 'dskjfhgjsdhfgkjsdhf',
            'viber_text' => 'sdlfkjsoifjgsdfgdsfgds',
            'sms_text'   => 'sdfoidsfgiodssdfsdf',
        ];

        $this->actingAs($user)
            ->post(route('sms-patterns.store'), $attrs)
            ->assertStatus(403);
    }





}
