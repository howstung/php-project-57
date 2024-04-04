<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }

    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    public function create()
    {
        $label = new Label();
        return view('label.create', compact('label'));
    }

    public function store(LabelRequest $request)
    {
        $label = new Label();
        $label->fill($request->validated());
        $label->save();
        flash(__('views.label.flash.store'))->success();
        return redirect()->route('label.index');
    }


    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function update(LabelRequest $request, Label $label)
    {
        $label->update($request->validated());
        flash(__('views.label.flash.update'))->success();
        return redirect()->route('label.index');
    }

    public function destroy(Label $label)
    {
        if (count($label->tasks) > 0) {
            flash(__('views.label.flash.destroy.fail'))->error();
        } else {
            $label->delete();
            flash(__('views.label.flash.destroy.success'))->success();
        }
        return redirect()->route('label.index');
    }
}
