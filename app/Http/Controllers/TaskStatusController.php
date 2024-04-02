<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class);
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:task_statuses',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique', ['model' => __('views.task_status.name')]),
        ];
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

    public function store(Request $request)
    {
        $data = $this->getValidatedData($request);

        $task_status = new TaskStatus();
        $task_status->fill($data);
        $task_status->save();

        flash(__('views.task_status.flash.store'))->success();

        return redirect()->route('status.index');
    }

    public function edit(TaskStatus $task_status)
    {
        $status = $task_status;
        return view('task_status.edit', compact('status'));
    }

    public function update(Request $request, TaskStatus $task_status)
    {
        $data = $this->getValidatedData($request, $task_status);
        $task_status->update($data);
        flash(__('views.task_status.flash.update'))->success();
        return redirect()->route('status.index');
    }

    public function destroy(TaskStatus $task_status)
    {
        if (count($task_status->tasks) == 0) {
            $task_status->delete();
            flash(__('views.task_status.flash.destroy.success'))->success();
        } else {
            flash(__('views.task_status.flash.destroy.fail'))->error();
        }
        return redirect()->route('status.index');
    }
}
