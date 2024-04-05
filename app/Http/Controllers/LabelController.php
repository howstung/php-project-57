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
        $model = 'label';
        $action = 'store';

        return view('parts.form_wrapper_store_update', compact('label', 'model', 'action'));
    }

    public function store(LabelRequest $request)
    {
        $label = new Label();
        $label->fill($request->validated());
        $label->save();
        flash(__('flash.label.store'))->success();

        return redirect()->route('label.index');
    }

    public function edit(Label $label)
    {
        $model = 'label';
        $action = 'update';

        return view('parts.form_wrapper_store_update', compact('label', 'model', 'action'));
    }

    public function update(LabelRequest $request, Label $label)
    {
        $label->update($request->validated());
        flash(__('flash.label.update'))->success();

        return redirect()->route('label.index');
    }

    public function destroy(Label $label)
    {
        if (count($label->tasks) > 0) {
            flash(__('flash.label.destroy.fail'))->error();
        } else {
            $label->delete();
            flash(__('flash.label.destroy.success'))->success();
        }

        return redirect()->route('label.index');
    }
}
