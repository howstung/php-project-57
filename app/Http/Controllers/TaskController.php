<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    private function makeSelectArray(Collection $collection, string $key = 'id', string $value = 'name'): array
    {
        $array = $collection->toArray();
        $select = [];
        foreach ($array as $item) {
            $select[$item[$key]] = $item[$value];
        }
        return $select;
    }

    private function saveLabels($request, $task, $action = 'save')
    {
        $labels = $request->toArray()['labels'] ?? [];
        $LabelsObjects = [];
        foreach ($labels as $label) {
            $LabelsObjects[] = Label::findOrFail($label);
        }
        if ($action === 'update') {
            DB::table('label_task')->where('task_id', '=', $task->id)->delete();
        }
        $task->labels()->saveMany($LabelsObjects);
    }

    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters('status_id', 'created_by_id', 'assigned_to_id')
            //->paginate(10);
        ->get();


        $authors = $executors = $this->makeSelectArray(User::all());
        $statuses = $this->makeSelectArray(TaskStatus::all());

        $status_selected = $request->get('filter')['status_id'] ?? null;
        $author_selected = $request->get('filter')['created_by_id'] ?? null;
        $executor_selected = $request->get('filter')['assigned_to_id'] ?? null;

/*        $perPage = $tasks->perPage();

        $total = $tasks->total();
        $lastPage = $tasks->lastPage();
        $currentPage = $tasks->currentPage() > $lastPage ? 1 : $tasks->currentPage();*/


        return view('task.index', compact(
            'tasks',
            'statuses',
            'authors',
            'executors',
            'status_selected',
            'author_selected',
            'executor_selected',
            /*            'perPage',
            'currentPage',
            'total',
            'lastPage'*/
        ));
    }

    public function create()
    {
        $task = new Task();

        $users = $this->makeSelectArray(User::all());
        $statuses = $this->makeSelectArray(TaskStatus::all());
        $labels = $this->makeSelectArray(Label::all());

        $model = 'task';
        $action = 'store';
        return view(
            'parts.form_wrapper_store_update',
            compact('task', 'model', 'action', 'users', 'statuses', 'labels')
        );
    }

    public function store(TaskRequest $request)
    {
        $task = new Task();
        $task->fill($request->validated());
        $task->created_by_id = Auth::user()->id;
        $task->save();

        $this->saveLabels($request, $task);
        flash(__('views.task.flash.store'))->success();

        return redirect()->route('task.index');
    }

    public function show(Task $task)
    {
        $labels = $task->labels();
        return view('task.show', compact('task', 'labels'));
    }

    public function edit(Task $task)
    {
        $users = $this->makeSelectArray(User::all());
        $statuses = $this->makeSelectArray(TaskStatus::all());
        $labels = $this->makeSelectArray(Label::all());

        $model = 'task';
        $action = 'update';
        return view(
            'parts.form_wrapper_store_update',
            compact('task', 'model', 'action', 'users', 'statuses', 'labels')
        );
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        $this->saveLabels($request, $task, 'update');

        flash(__('views.task.flash.update'))->success();

        return redirect()->route('task.index');
    }

    public function destroy(Task $task)
    {
        if ($task->author->id === Auth::user()->id) {
            $task->delete();
            flash(__('views.task.flash.destroy.success'))->success();
        } else {
            flash(__('views.task.flash.destroy.fail'))->error();
        }
        return redirect()->route('task.index');
    }
}
