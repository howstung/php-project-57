@extends('layouts.app')

@section('content')
            <h1 class="mb-5">Создать задачу</h1>

            <div class="col-md-6">

                {{ Form::model($task, ['route' => 'task.store']) }}

                @include('task.form')

                {{ Form::submit('Создать', ['class' => 'btn btn-secondary mt-3 mb-3']) }}
                {{ Form::close() }}

            </div>
@endsection
