<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
    public function create(Request $request)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $status = new TaskStatus();
        return view('task_status.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $data = $this->validate($request, [
            'name' => 'required|min:1|unique:task_statuses',
        ]);

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();

        flash(__('views.task_status.flash.store'))->success();

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
    public function edit(Request $request, string $id)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $status = TaskStatus::findOrFail($id);
        return view('task_status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $status = TaskStatus::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|min:1|unique:task_statuses,name,' . $status->id,
        ]);

        $status->update($data);

        flash(__('views.task_status.flash.update'))->success();

        return redirect()
            ->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $status = TaskStatus::find($id);
        if ($status && count($status->tasks) == 0) {
            $status->delete();
            flash(__('views.task_status.flash.destroy.success'))->success();
        } else {
            flash(__('views.task_status.flash.destroy.fail'))->error();
        }
        return redirect()->route('status.index');
    }
}
