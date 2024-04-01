@include('parts.form_errors')

{{ Form::label('name', __('views.task.table.name'), ['class'=>'form-label']) }}
{{ Form::text('name',  null, ['class' => 'form-control']) }}


{{ Form::label('description', __('views.task.table.description'), ['class'=>'form-label']) }}
{{ Form::textarea('description',  null, ['class' => 'form-control']) }}


{{ Form::label('status_id', __('views.task.table.status'), ['class'=>'form-label']) }}
{{ Form::select('status_id',  $statuses, $task->status->id ?? null, ['class'=>'form-select']) }}


{{ Form::label('assigned_to_id', __('views.task.table.executor'), ['class'=>'form-label']) }}
{{ Form::select('assigned_to_id',  $users, $task->executor->id ?? null, ['class'=>'form-select']) }}


{{ Form::label('labels', __('views.task.table.labels'), ['class'=>'form-label']) }}
{{ Form::select('labels',  $labels, $task->labels ?? null, ['class'=>'form-select', 'multiple', 'name'=>'labels[]']) }}
