<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters('status_id', 'created_by_id', 'assigned_to_id')
            ->paginate(5);
            //->get();


        $authors = $executors = $this->makeSelectArray(User::all());
        $statuses = $this->makeSelectArray(TaskStatus::all());

        $status_selected = $request->get('filter')['status_id'] ?? null;
        $author_selected = $request->get('filter')['created_by_id'] ?? null;
        $executor_selected = $request->get('filter')['assigned_to_id'] ?? null;

        $perPage = $tasks->perPage();

        $total = $tasks->total();
        $lastPage = $tasks->lastPage();
        $currentPage = $tasks->currentPage() > $lastPage ? 1 : $tasks->currentPage();


        //var_dump($tasks);

        return view('task.index', compact(
            'tasks',
            'statuses',
            'authors',
            'executors',
            'status_selected',
            'author_selected',
            'executor_selected',
            'perPage',
            'currentPage',
            'total',
            'lastPage'
        ));
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $task = new Task();

        $users = $this->makeSelectArray(User::all());
        $statuses = $this->makeSelectArray(TaskStatus::all());
        $labels = $this->makeSelectArray(Label::all());

        return view('task.create', compact('task', 'users', 'statuses', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $data = $this->validate($request, [
            'name' => 'required|min:1|unique:tasks',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
        ]);

        $task = new Task();
        $task->fill($data);
        $task->created_by_id = Auth::user()->id;

        $labels = $request->toArray()['labels'] ?? [];
        $LabelsObjects = [];
        foreach ($labels as $label) {
            $LabelsObjects[] = Label::findOrFail($label);
        }

        $task->save();
        $task->labels()->saveMany($LabelsObjects);

        flash(__('views.task.flash.store'))->success();

        return redirect()
            ->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $labels = $task->labels();
        return view('task.show', compact('task', 'labels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $task = Task::findOrFail($id);

        $users = $this->makeSelectArray(User::all());
        $statuses = $this->makeSelectArray(TaskStatus::all());
        $labels = $this->makeSelectArray(Label::all());

        return view('task.edit', compact('task', 'users', 'statuses', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $task = Task::findOrFail($id);

        $data = $this->validate($request, [
            'name' => 'required|min:1|unique:tasks,name,' . $task->id,
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
        ]);

        $task->update($data);

        $labels = $request->toArray()['labels'] ?? [];
        $LabelsObjects = [];
        foreach ($labels as $label) {
            $LabelsObjects[] = Label::findOrFail($label);
        }
        DB::table('label_task')->where('task_id', '=', $task->id)->delete();
        $task->labels()->saveMany($LabelsObjects);

        flash(__('views.task.flash.update'))->success();

        return redirect()
            ->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Gate::authorize('auth-for-crud', Auth::user());

        $task = Task::find($id);

        if ($task && $task->author->id === Auth::user()->id) {
            $task->delete();
            flash(__('views.task.flash.destroy.success'))->success();
        } else {
            flash(__('views.task.flash.destroy.fail'))->error();
        }
        return redirect()->route('task.index');
    }
}
