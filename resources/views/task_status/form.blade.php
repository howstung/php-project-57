@include('form_errors')

{{ Form::label('name', 'Имя', ['class'=>'form-label']) }}
{{ Form::text('name',  null, ['class' => 'form-control']) }}
