<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = TaskStatus::all();
        return view('task_status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = new TaskStatus();
        return view('task_status.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:1|unique:task_statuses',
        ]);

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();

        flash(__('flash.status.created'))->success();

        return redirect()
            ->route('status.index');
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
        $status = TaskStatus::findOrFail($id);
        return view('task_status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $status = TaskStatus::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|min:1|unique:task_statuses,name,' . $status->id,
        ]);

        $status->fill($data);
        $status->save();

        flash(__('flash.status.edited'))->success();

        return redirect()
            ->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = TaskStatus::find($id);
        if ($status) {
            $status->delete();
            flash(__('flash.status.deleted'))->success();
        } else {
            flash(__('flash.status.not_deleted'))->error();
        }
        return redirect()->route('status.index');
    }
}
