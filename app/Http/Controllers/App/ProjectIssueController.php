<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectIssueResource;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectIssueController extends Controller
{
    public function index(Project $project)
    {
        $issues = ProjectIssueResource::collection($project->issues);

        return inertia('Projects/Issues/Index', compact('issues'));
    }
}
