{{ Form::model(null, ['route' => ['task.index'], 'method' => 'GET']) }}

<div class="row">

    <div class="col-md-3">
        {{ Form::select('status_id',  $statuses, $status_selected, ['placeholder' => __('views.task.table.status'),'class'=>'form-select', 'name'=>'filter[status_id]']) }}
    </div>

    <div class="col-md-3">
        {{ Form::select('created_by_id',  $authors, $author_selected, ['placeholder' => __('views.task.table.author'),'class'=>'form-select', 'name'=>'filter[created_by_id]']) }}
    </div>

    <div class="col-md-3">
        {{ Form::select('assigned_to_id',  $executors, $executor_selected, ['placeholder' => __('views.task.table.executor'),'class'=>'form-select', 'name'=>'filter[assigned_to_id]']) }}
    </div>

    <div class="col-md-3">
        {{ Form::submit(__('views.task.filter.submit'), ['class' => 'btn btn-secondary mb-3']) }}
    </div>

</div>

{{ Form::close() }}


