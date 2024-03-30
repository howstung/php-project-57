@extends('layouts.app')

@section('content')
            <h1 class="mb-5">Изменение задачи</h1>

            <div class="col-md-6">

                {{ Form::model($task, ['route' => ['task.update', $task], 'method' => 'PATCH']) }}

                @include('task.form')

                {{ Form::submit('Обновить', ['class' => 'btn btn-secondary mt-3 mb-3']) }}
                {{ Form::close() }}

            </div>
@endsection
