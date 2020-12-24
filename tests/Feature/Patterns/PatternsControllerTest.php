<?php

namespace Tests\Feature\Patterns;
use App\Models\Messages\Pattern;
use App\Models\Roles\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatternsControllerTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithAuthentication;

    /**
     * @test
     */
    public function route_index_requires_authentication()
    {
        $this->get(route('patterns.index'))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_create_requires_authentication()
    {
        $this->get(route('patterns.create'))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_show_requires_authentication()
    {
        $pattern = Pattern::factory()->create();

        $this->get(route('patterns.show', $pattern))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_store_requires_authentication()
    {
        $this->post(route('patterns.store'))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_edit_requires_authentication()
    {
        $pattern = Pattern::factory()->create();

        $this->get(route('patterns.edit', $pattern))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_update_requires_authentication()
    {
        $pattern = Pattern::factory()->create();

        $this->put(route('patterns.update', $pattern))->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function route_destroy_requires_authentication()
    {
        $pattern = Pattern::factory()->create();

        $this->delete(route('patterns.destroy', $pattern))->assertRedirect(route('login'));
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
            ->get(route('patterns.index'))
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
            ->get(route('patterns.index'))
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
            ->get(route('patterns.create'))
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
            ->get(route('patterns.create'))
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
            ->get(route('patterns.show', $pattern->id))
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
            ->get(route('patterns.show', $pattern->id))
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
            ->post(route('patterns.store'), $attrs);

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
            ->post(route('patterns.store'), $attrs)
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function route_edit_not_allowed_for_operators()
    {
        $user = User::factory()->create([
            'role_id' => Role::OPERATOR
        ]);

        $pattern = Pattern::factory()->create();

        $this->actingAs($user)
            ->get(route('patterns.edit', $pattern))
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function route_edit_allowed_only_for_admins()
    {
        $user = User::factory()->create([
            'role_id' => Role::ADMIN
        ]);

        $pattern = Pattern::factory()->create();

        $this->actingAs($user)
            ->get(route('patterns.edit', $pattern))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function admins_can_update_patters()
    {
        $user = User::factory()->create([
            'role_id' => Role::ADMIN
        ]);

        $pattern = Pattern::factory()->create([
            'theme'      => 'My theme',
            'sms_text'   => 'My text for sms message',
            'viber_text' => 'My text for viber message',
            'tag'        => 'My custom tag',
        ]);

        $attrs = [
            'theme'      => 'My theme',
            'sms_text'   => 'My text for sms message AND I CHANGE IT',
            'viber_text' => 'My text for viber message AND I CHANGE IT',
            'tag'        => 'My custom tag',
        ];

        $response = $this->actingAs($user)
            ->put(route('patterns.update', $pattern->id), $attrs);

        $this->assertDatabaseHas('patterns', [
            'sms_text'   => 'My text for sms message AND I CHANGE IT',
            'viber_text' => 'My text for viber message AND I CHANGE IT',
        ]);

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function admins_can_delete_patterns()
    {
        $user = User::factory()->create([
            'role_id' => Role::ADMIN
        ]);

        $pattern = Pattern::factory()->create([
            'sms_text'   => 'My text for sms message1111',
            'viber_text' => 'My text for viber message1111',
        ]);

       $this->actingAs($user)
            ->delete(route('patterns.destroy', $pattern->id));

        $this->assertDatabaseMissing('patterns', [
            'sms_text'   => 'My text for sms message1111',
            'viber_text' => 'My text for viber message1111',
        ]);
    }

}
