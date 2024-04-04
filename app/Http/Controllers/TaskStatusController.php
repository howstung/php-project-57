<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class);
    }

    public function index()
    {
        $task_statuses = TaskStatus::all();
        return view('task_status.index', compact('task_statuses'));
    }

    public function create()
    {
        $task_status = new TaskStatus();
        $model = 'task_status';
        $action = 'store';
        return view('parts.form_wrapper_store_update', compact('task_status', 'model', 'action'));
    }

    public function store(TaskStatusRequest $request)
    {
        $task_status = new TaskStatus();
        $task_status->fill($request->validated());
        $task_status->save();

        flash(__('views.task_status.flash.store'))->success();

        return redirect()->route('task_status.index');
    }

    public function edit(TaskStatus $task_status)
    {
        $model = 'task_status';
        $action = 'update';
        return view('parts.form_wrapper_store_update', compact('task_status', 'model', 'action'));
    }

    public function update(TaskStatusRequest $request, TaskStatus $task_status)
    {
        $task_status->update($request->validated());
        flash(__('views.task_status.flash.update'))->success();
        return redirect()->route('task_status.index');
    }

    public function destroy(TaskStatus $task_status)
    {
        if (count($task_status->tasks) == 0) {
            $task_status->delete();
            flash(__('views.task_status.flash.destroy.success'))->success();
        } else {
            flash(__('views.task_status.flash.destroy.fail'))->error();
        }
        return redirect()->route('task_status.index');
    }
}
