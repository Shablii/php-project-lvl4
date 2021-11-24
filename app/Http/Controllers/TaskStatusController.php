<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    public function index(): View
    {
        $statuses = TaskStatus::paginate(10);
        return view('statuses.index', compact('statuses'));
    }

    public function create(TaskStatus $status): View
    {
        return view('statuses.create', compact('status'));
    }

    public function store(StatusRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();

        flash('Статус успешно создан')->success();
        return redirect()->route('task_statuses.index');
    }

    public function edit(int $id): View
    {
        $status = TaskStatus::findOrFail($id);
        return view('statuses.edit', compact('status'));
    }

    public function update(StatusRequest $request, int $id): RedirectResponse
    {
        $status = TaskStatus::findOrFail($id);

        $data = $request->validated();
        $status->fill($data);
        $status->save();

        flash('Статус успешно изменён')->success();
        return redirect()->route('task_statuses.index');
    }

    public function destroy(int $id): RedirectResponse
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
