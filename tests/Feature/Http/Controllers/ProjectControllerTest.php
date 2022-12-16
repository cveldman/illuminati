<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Project;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    public Project $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->project = Project::factory()->create();
    }

    public function testIndex()
    {
        $this->get(route('projects.index'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Projects/Index')
                ->has('projects', 1, fn (Assert $page) => $page
                    ->hasAll([
                        'id',
                        'name',
                    ])
                )
            );
    }

    public function testCreate()
    {
        $this->get(route('projects.create'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Projects/Create'));
    }

    public function testStore()
    {
        $data = [
            'name' => 'Project',
        ];

        $this->post(route('projects.store'), $data)
            ->assertValid()
            ->assertRedirectToRoute('projects.index');

        $this->assertDatabaseHas(Project::class, $data);
    }

    public function testShow()
    {
        $this->get(route('projects.show', $this->project))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Projects/Show'));
    }

    public function testEdit()
    {
        $this->get(route('projects.edit', $this->project))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Projects/Edit')
                ->has('project', fn (Assert $page) => $page
                    ->hasAll([
                        'id',
                        'name',
                    ])
                )
            );
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'Project 2',
        ];

        $this->put(route('projects.update', $this->project), $data)
            ->assertValid()
            ->assertRedirectToRoute('projects.index');

        $this->assertDatabaseHas(Project::class, $data);
    }

    public function testDestroy()
    {
        $this->delete(route('projects.destroy', $this->project))
            ->assertRedirectToRoute('projects.index');

        $this->assertDatabaseMissing(Project::class, ['id' => $this->project->id]);
    }
}
