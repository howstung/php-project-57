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
use Spatie\QueryBuilder\AllowedFilter;
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

    private function getSelected(Request $request): array
    {
        $status_selected = $request->get('filter')['status_id'] ?? null;
        $author_selected = $request->get('filter')['created_by_id'] ?? null;
        $executor_selected = $request->get('filter')['assigned_to_id'] ?? null;
        return [$status_selected, $author_selected, $executor_selected];
    }

    private function getPaginationData(mixed $tasks): array
    {
        $perPage = $tasks->perPage();
        $total = $tasks->total();
        $lastPage = $tasks->lastPage();
        $currentPage = $tasks->currentPage() > $lastPage ? 1 : $tasks->currentPage();
        return [$perPage, $total, $lastPage, $currentPage];
    }

    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),])
            ->paginate(10);

        $statuses = $this->makeSelectArray(TaskStatus::all());
        $authors = $executors = $this->makeSelectArray(User::all());

        [$status_selected, $author_selected, $executor_selected] = $this->getSelected($request);
        [$perPage, $total, $lastPage, $currentPage] = $this->getPaginationData($tasks);

        return view('task.index', compact(
            'tasks',
            'statuses',
            'authors',
            'executors',
            'status_selected',
            'author_selected',
            'executor_selected',
            'perPage',
            'total',
            'lastPage',
            'currentPage',
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
        $task->created_by_id = (int)Auth::id();
        $task->save();

        $labels = $request->toArray()['labels'] ?? [];
        $task->labels()->attach($labels);

        flash(__('flash.task.store'))->success();

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

        $labels = $request->toArray()['labels'] ?? [];
        $task->labels()->sync($labels);

        flash(__('flash.task.update'))->success();

        return redirect()->route('task.index');
    }

    public function destroy(Task $task)
    {
        if ($task->author()->is(Auth::user())) {
            $task->delete();
            flash(__('flash.task.destroy.success'))->success();
        } else {
            flash(__('flash.task.destroy.fail'))->error();
        }

        return redirect()->route('task.index');
    }
}
