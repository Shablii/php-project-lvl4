<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    public function index()
    {
        $statuses = TaskStatus::paginate(10);
        return view('statuses.index', compact('statuses'));
    }

    public function create(TaskStatus $status)
    {
        return view('statuses.create', compact('status'));
    }

    public function store(StoreStatusRequest $request)
    {
        $data = $request->validated();

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();

        flash('Статус успешно создан')->success();
        return redirect()->route('task_statuses.index');
    }

    public function edit($id)
    {
        $status = TaskStatus::findOrFail($id);
        return view('statuses.edit', compact('status'));
    }

    public function update(StoreStatusRequest $request, $id)
    {
        $status = TaskStatus::findOrFail($id);

        $data = $request->validated();
        $status->fill($data);
        $status->save();
        return redirect()->route('task_statuses.index');
    }

    public function destroy($id)
    {
        $status = TaskStatus::findOrFail($id);

        if (count($status->tasks) == 0) {
            $status->delete();

            flash('Статус успешно удалён')->success();
            return redirect()->route('task_statuses.index');
        }

        flash('Не удалось удалить статус ')->error();
        return redirect()->route('task_statuses.index');
    }
}
