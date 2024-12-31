<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::with('user')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        Gate::authorize('create', Task::class);
        $users = User::all();

        return view('tasks.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', Task::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'due_date' => 'required|date',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        Task::create([
            'name' => $request->name,
            'due_date' => $request->due_date,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task): View
    {
        Gate::authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        Gate::authorize('update', $task);

        $task->update($request->only('name', 'due_date'));

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
