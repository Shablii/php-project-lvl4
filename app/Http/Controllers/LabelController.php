<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::paginate(10);
        return view('labels.index', compact('labels'));
    }

    public function create(Label $label)
    {
        return view('labels.create', compact('label'));
    }

    public function store(StoreLabelRequest $request)
    {
        $data = $request->validated();

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash('Метка успешно создана ')->success();
        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, Label $label)
    {
        $data = $request->validated();

        $label->fill($data);
        $label->save();

        flash('Метка успешно создана ')->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
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
