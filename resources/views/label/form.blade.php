@include('parts.form_errors')

{{ Form::label('name', __('views.label.table.name'), ['class'=>'form-label']) }}
{{ Form::text('name',  null, ['class' => 'form-control']) }}

{{ Form::label('description', __('views.label.table.description'), ['class'=>'form-label']) }}
{{ Form::textarea('description',  null, ['class' => 'form-control']) }}
