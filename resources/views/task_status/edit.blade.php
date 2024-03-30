@extends('layouts.app')

@section('content')
            <h1 class="mb-5">Изменение статуса</h1>

            <div class="col-md-6">

                {{ Form::model($status, ['route' => ['status.update', $status], 'method' => 'PATCH']) }}

                @include('task_status.form')

                {{ Form::submit('Обновить', ['class' => 'btn btn-secondary mt-3 mb-3']) }}
                {{ Form::close() }}

            </div>
@endsection
