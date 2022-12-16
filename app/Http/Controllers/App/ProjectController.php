<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class);
    }

    public function index()
    {
        $projects = ProjectResource::collection(Project::all());

        return inertia('Projects/Index', compact('projects'));
    }

    public function create()
    {
        return inertia('Projects/Create');
    }

    public function store(StoreProjectRequest $request)
    {
        Project::create($request->validated());

        return to_route('projects.index');
    }

    public function show(Project $project)
    {
        return inertia('Projects/Show', ['project' => new ProjectResource($project)]);
    }

    public function edit(Project $project)
    {
        return inertia('Projects/Edit', ['project' => new ProjectResource($project)]);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return to_route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('projects.index');
    }
}
