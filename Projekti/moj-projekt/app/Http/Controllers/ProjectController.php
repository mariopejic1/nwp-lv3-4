<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'cijena' => 'nullable|numeric',
            'datum_pocetka' => 'nullable|date',
            'datum_zavrsetka' => 'nullable|date',
            'clanovi' => 'array',
        ]);

        $project = Project::create([
            'naziv' => $request->naziv,
            'opis' => $request->opis,
            'cijena' => $request->cijena,
            'datum_pocetka' => $request->datum_pocetka,
            'datum_zavrsetka' => $request->datum_zavrsetka,
            'user_id' => Auth::id(),
        ]);

        if ($request->clanovi) {
            $project->clanovi()->sync($request->clanovi);
        }

        return redirect()->route('dashboard')->with('success', 'Projekt kreiran!');
    }

    public function edit(Project $project)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $tasks = $project->tasks()->with('user')->get();

        return view('projects.edit', compact('project', 'users', 'tasks'));
    }

    public function update(Request $request, Project $project)
    {
        if (Auth::id() === $project->user_id) {
            $request->validate([
                'naziv' => 'required|string|max:255',
                'opis' => 'nullable|string',
                'cijena' => 'nullable|numeric',
                'datum_pocetka' => 'nullable|date',
                'datum_zavrsetka' => 'nullable|date',
                'clanovi' => 'array',
                'novi_task' => 'nullable|string',
            ]);

            $project->update([
                'naziv' => $request->naziv,
                'opis' => $request->opis,
                'cijena' => $request->cijena,
                'datum_pocetka' => $request->datum_pocetka,
                'datum_zavrsetka' => $request->datum_zavrsetka,
            ]);

            if ($request->clanovi) {
                $project->clanovi()->sync($request->clanovi);
            }

            if ($request->novi_task) {
                ProjectTask::create([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'opis_posla' => $request->novi_task,
                ]);
            }
        } else {
            $request->validate([
                'novi_task' => 'required|string',
            ]);

            ProjectTask::create([
                'project_id' => $project->id,
                'user_id' => Auth::id(),
                'opis_posla' => $request->novi_task,
            ]);
        }

        return redirect()->route('projects.edit', $project)->with('success', 'Projekt ažuriran!');
    }

    public function show(Project $project)
    {
        $tasks = $project->tasks()->with('user')->get();
        return view('projects.show', compact('project', 'tasks'));
    }
}
