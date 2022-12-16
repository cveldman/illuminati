<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $this->get(route('users.index'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Users/Index')
                ->has('users', 1, fn (Assert $page) => $page
                    ->hasAll([
                        'id',
                        'name',
                    ])
                )
            );
    }

    public function testCreate()
    {
        $this->get(route('users.create'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Users/Create'));
    }

    public function testStore()
    {
        $data = [
            'name' => 'User',
            'email' => 'user@example.com'
        ];

        $this->post(route('users.store'), $data)
            ->assertValid()
            ->assertRedirectToRoute('users.index');

        $this->assertDatabaseHas(User::class, $data);
    }

    public function testShow()
    {
        $this->get(route('users.show', $this->user))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Users/Show'));
    }

    public function testEdit()
    {
        $this->get(route('users.edit', $this->user))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Users/Edit')
                ->has('user', fn (Assert $page) => $page
                    ->hasAll([
                        'id',
                        'name',
                        'avatar',
                    ])
                )
            );
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'User 2',
        ];

        $this->put(route('users.update', $this->user), $data)
            ->assertValid()
            ->assertRedirectToRoute('users.index');

        $this->assertDatabaseHas(User::class, $data);
    }

    public function testDestroy()
    {
        $this->delete(route('users.destroy', $this->user))
            ->assertRedirectToRoute('users.index');

        $this->assertDatabaseMissing(User::class, ['id' => $this->user->id]);
    }
}
