<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:labels',
            'description' => 'nullable'
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique', ['model' => __('views.label.name')]),
        ];
    }

    /**
     * Display a listing of the resource.
     */
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

    public function store(Request $request)
    {
        $data = $this->getValidatedData($request);

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash(__('views.label.flash.store'))->success();

        return redirect()->route('label.index');
    }


    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $data = $this->getValidatedData($request, $label);
        $label->update($data);
        flash(__('views.label.flash.update'))->success();
        return redirect()->route('label.index');
    }

    public function destroy(Label $label)
    {
        if (count($label->tasks) == 0) {
            $label->delete();
            flash(__('views.label.flash.destroy.success'))->success();
        } else {
            flash(__('views.label.flash.destroy.fail'))->error();
        }
        return redirect()->route('label.index');
    }
}
