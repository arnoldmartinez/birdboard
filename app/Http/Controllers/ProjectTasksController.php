<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\RedirectResponse;

class ProjectTasksController extends Controller
{
    /**
     * Add a task to the given project.
     *
     * @param  Project $project
     * @return RedirectResponse
     */
    public function store(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }
}
