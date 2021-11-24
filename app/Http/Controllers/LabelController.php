<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LabelController extends Controller
{
    public function index(): View
    {
        $labels = Label::paginate(10);
        return view('labels.index', compact('labels'));
    }

    public function create(Label $label): View
    {
        return view('labels.create', compact('label'));
    }

    public function store(LabelRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash('Метка успешно создана')->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
        $data = $request->validated();

        $label->fill($data);
        $label->save();

        flash('Метка успешно изменена')->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
    {
        if (count($label->tasks()->get()) == 0) {
            $label->delete();

            flash('Метка успешно удалена')->success();
            return redirect()->route('labels.index');
        }

        flash('Не удалось удалить метку')->error();
        return redirect()->route('labels.index');
    }
}
