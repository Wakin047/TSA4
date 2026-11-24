<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompletedMail;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::query()
            ->where('is_archived', false)
            ->orderBy('due_date')
            ->orderBy('created_at')
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        return view('tasks.create', ['task' => new Task]);
    }

    public function archived(): View
    {
        $tasks = Task::query()
            ->where('is_archived', true)
            ->orderBy('due_date')
            ->orderBy('created_at')
            ->paginate(10);

        return view('tasks.archived', compact('tasks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Task created successfully.');
    }

    public function show(int $task): View
    {
        $task = $this->activeTask($task);

        return view('tasks.show', compact('task'));
    }

    public function edit(int $task): View
    {
        $task = $this->activeTask($task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, int $task): RedirectResponse
    {
        $task = $this->activeTask($task);
        $validated = $request->validate($this->rules());
        $wasDone = $task->status === 'done';

        $task->update($validated);

        if (! $wasDone && $task->status === 'done') {
            Mail::to(config('mail.task_notification_recipient'))
                ->send(new TaskCompletedMail($task));
        }

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Task updated successfully.');
    }

    public function destroy(int $task): RedirectResponse
    {
        $task = $this->activeTask($task);
        $task->is_archived = true;
        $task->save();

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Task archived successfully.');
    }

    public function destroyPermanently(int $task): RedirectResponse
    {
        $this->activeTask($task)->delete();

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Task permanently deleted.');
    }

    private function activeTask(int $id): Task
    {
        return Task::query()
            ->where('is_archived', false)
            ->findOrFail($id);
    }

    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:180'],
            'description' => ['nullable', 'string', 'max:5000'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(array_keys(Task::STATUSES))],
        ];
    }
}
