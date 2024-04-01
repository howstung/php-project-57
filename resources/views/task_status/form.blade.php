@include('parts.form_errors')

{{ Form::label('name',  __('views.task_status.table.name'), ['class'=>'form-label']) }}
{{ Form::text('name',  null, ['class' => 'form-control']) }}
