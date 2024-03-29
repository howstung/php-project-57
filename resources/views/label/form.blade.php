@include('form_errors')

{{ Form::label('name', 'Имя', ['class'=>'form-label']) }}
{{ Form::text('name',  null, ['class' => 'form-control']) }}

{{ Form::label('description', 'Описание', ['class'=>'form-label']) }}
{{ Form::textarea('description',  null, ['class' => 'form-control']) }}
