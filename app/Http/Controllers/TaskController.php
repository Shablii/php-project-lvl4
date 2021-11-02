<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create(Task $task)
    {
        $users = User::all()->pluck('name', 'id')->sort();
        $users[''] = '----------';
        $statuses = TaskStatus::all()->pluck('name', 'id')->sort();
        $statuses[''] = '----------';
        return view('tasks.create', compact('task', 'users', 'statuses'));
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        $task = new Task();
        $task->fill($data);
        $task->created_by_id = Auth::id();
        $task->save();

        flash('Задача успешно создана')->success();
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
        $users[''] = '----------';
        $statuses = TaskStatus::all()->pluck('name', 'id')->sort();
        $statuses[''] = '----------';
        return view('tasks.edit', compact('task', 'users', 'statuses'));
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->validated();

        $task->fill($data);
        $task->save();

        flash('Задача успешно изменена')->success();
        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        flash('Задача успешно удалена')->success();
        return redirect()->route('tasks.index');
    }
}
