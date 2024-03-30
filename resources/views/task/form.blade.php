@include('form_errors')

{{ Form::label('name', 'Имя', ['class'=>'form-label']) }}
{{ Form::text('name',  null, ['class' => 'form-control']) }}


{{ Form::label('description', 'Описание', ['class'=>'form-label']) }}
{{ Form::textarea('description',  null, ['class' => 'form-control']) }}


{{ Form::label('status_id', 'Статус', ['class'=>'form-label']) }}
{{ Form::select('status_id',  $statuses, $task->status->id ?? null, ['class'=>'form-select']) }}


{{ Form::label('assigned_to_id', 'Исполнитель', ['class'=>'form-label']) }}
{{ Form::select('assigned_to_id',  $users, $task->executor->id ?? null, ['class'=>'form-select']) }}


{{ Form::label('labels', 'Метки', ['class'=>'form-label']) }}
{{ Form::select('labels',  $labels, $task->labels ?? null, ['class'=>'form-select', 'multiple', 'name'=>'labels[]']) }}
