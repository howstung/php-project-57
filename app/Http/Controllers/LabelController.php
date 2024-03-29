<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $label = new Label();
        return view('label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:1|unique:labels',
            'description' => 'nullable',
        ]);

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash(__('flash.label.created'))->success();

        return redirect()
            ->route('label.index');
    }

    /**
     * Display the specified resource.
     */
    /*    public function show(string $id)
        {

        }*/

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $label = Label::findOrFail($id);
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $label = Label::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|min:1|unique:labels,name,'.$label->id,
            'description' => 'nullable',
        ]);

        $label->fill($data);
        $label->save();

        flash(__('flash.label.edited'))->success();

        return redirect()
            ->route('label.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $label = Label::find($id);
        if ($label) {
            $label->delete();
            flash(__('flash.label.deleted'))->success();
        } else {
            flash(__('flash.label.not_deleted'))->error();
        }
        return redirect()->route('label.index');
    }
}
