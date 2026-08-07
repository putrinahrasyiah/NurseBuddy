<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the user's tasks.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'status' => ['nullable', Rule::in(Task::STATUSES)],
            'priority' => ['nullable', Rule::in(Task::PRIORITIES)],
        ]);

        $tasks = Task::query()
            ->whereBelongsTo($request->user())
            ->when(
                filled($filters['status'] ?? null),
                fn ($query) => $query->where('status', $filters['status'])
            )
            ->when(
                filled($filters['priority'] ?? null),
                fn ($query) => $query->where('priority', $filters['priority'])
            )
            ->orderByRaw("CASE WHEN is_urgent = 1 THEN 0 ELSE 1 END")
            ->orderBy('deadline')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('tasks.index', [
            'tasks' => $tasks,
            'priorities' => Task::PRIORITIES,
            'statuses' => Task::STATUSES,
            'selectedStatus' => $filters['status'] ?? null,
            'selectedPriority' => $filters['priority'] ?? null,
        ]);
    }

    /**
     * Show the form for creating a new task.
     */
    public function create(): View
    {
        return view('tasks.create', [
            'task' => new Task(),
            'priorities' => Task::PRIORITIES,
            'statuses' => Task::STATUSES,
        ]);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $task = new Task($request->validated());
        $task->is_urgent = $request->boolean('is_urgent');
        $task->user()->associate($request->user());
        $task->save();

        return Redirect::route('tasks.index')->with('status', 'task-created');
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Request $request, Task $task): View
    {
        $task = $this->ownedTask($request, $task);

        return view('tasks.edit', [
            'task' => $task,
            'priorities' => Task::PRIORITIES,
            'statuses' => Task::STATUSES,
        ]);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task = $this->ownedTask($request, $task);

        $task->fill($request->validated());
        $task->is_urgent = $request->boolean('is_urgent');
        $task->save();

        return Redirect::route('tasks.index')->with('status', 'task-updated');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Request $request, Task $task): RedirectResponse
    {
        $task = $this->ownedTask($request, $task);
        $task->delete();

        return Redirect::route('tasks.index')->with('status', 'task-deleted');
    }

    /**
     * Resolve task ownership for the current user.
     */
    protected function ownedTask(Request $request, Task $task): Task
    {
        abort_if($task->user_id !== $request->user()->id, 404);

        return $task;
    }
}
