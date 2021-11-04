<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all()->pluck('name', 'id')->sort();
        $statuses = TaskStatus::all()->pluck('name', 'id')->sort();

        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])->paginate(10);

        return view('tasks.index', compact('tasks', 'users', 'statuses'));
    }

    public function create(Task $task)
    {
        $users = User::all()->pluck('name', 'id')->sort();
        $statuses = TaskStatus::all()->pluck('name', 'id')->sort();
        $labels = Label::all()->pluck('name', 'id')->sort();

        return view('tasks.create', compact('task', 'users', 'statuses', 'labels'));
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        $task = new Task();
        $task->fill($data);
        $task->created_by_id = Auth::id();
        $task->save();

        if (isset($data['labels'])) {
            $labels = Label::find($data['labels']);
            $task->labels()->attach($labels);
        }

        flash('Задача успешно создана ')->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        $users = User::all()->pluck('name', 'id')->sort();
        $statuses = TaskStatus::all()->pluck('name', 'id')->sort();
        $labels = Label::all()->pluck('name', 'id')->sort();

        return view('tasks.edit', compact('task', 'users', 'statuses', 'labels'));
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->validated();

        $task->fill($data);
        $task->save();

        if (isset($data['labels'])) {
            $labels = Label::find($data['labels']);
            $task->labels()->detach();
            $task->labels()->attach($labels);
        }

        flash('Задача успешно изменена')->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();

        flash('Задача успешно удалена')->success();
        return redirect()->route('tasks.index');
    }
}
