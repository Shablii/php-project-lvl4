<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        $statuses = TaskStatus::all();

        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters(
                [
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
                ]
            )->paginate(10);

        return view('tasks.index', compact('tasks', 'users', 'statuses'));
    }

    public function create(Task $task): View
    {
        $users = User::all();
        $statuses = TaskStatus::all();
        $labels = Label::all();

        return view('tasks.create', compact('task', 'users', 'statuses', 'labels'));
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $task = new Task();
        $task->fill($data);
        $task->created_by_id = Auth::id();
        $task->save();

        if (isset($data['labels'])) {
            $labels = Label::findOrFail($data['labels']);
            $task->labels()->attach($labels);
        }

        flash('Задача успешно создана ')->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $users = User::all();
        $statuses = TaskStatus::all();
        $labels = Label::all();

        return view('tasks.edit', compact('task', 'users', 'statuses', 'labels'));
    }

    public function update(TaskRequest $request, int $id): RedirectResponse
    {
        $task = Task::findOrFail($id);
        $data = $request->validated();

        $task->fill($data);
        $task->save();

        if (isset($data['labels'])) {
            $labels = Label::findOrFail($data['labels']);
            $task->labels()->detach();
            $task->labels()->attach($labels);
        }

        flash('Задача успешно изменена')->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->labels()->detach();
        $task->delete();

        flash('Задача успешно удалена')->success();
        return redirect()->route('tasks.index');
    }
}
