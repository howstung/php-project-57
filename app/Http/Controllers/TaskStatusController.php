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
        $statuses = TaskStatus::all();
        return view('task_status.index', compact('statuses'));
    }

    public function create()
    {
        $status = new TaskStatus();
        return view('task_status.create', compact('status'));
    }

    public function store(TaskStatusRequest $request)
    {
        $task_status = new TaskStatus();
        $task_status->fill($request->validated());
        $task_status->save();

        flash(__('views.task_status.flash.store'))->success();

        return redirect()->route('status.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        $status = $taskStatus;
        return view('task_status.edit', compact('status'));
    }

    public function update(TaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $taskStatus->update($request->validated());
        flash(__('views.task_status.flash.update'))->success();
        return redirect()->route('status.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if (count($taskStatus->tasks) == 0) {
            $taskStatus->delete();
            flash(__('views.task_status.flash.destroy.success'))->success();
        } else {
            flash(__('views.task_status.flash.destroy.fail'))->error();
        }
        return redirect()->route('status.index');
    }
}
