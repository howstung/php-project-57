@extends('layouts.app')

@section('content')
            <h1 class="mb-5">Создать статус</h1>

            <div class="col-xl-3 col-lg-4 col-sm-6">

                {{ Form::model($status, ['route' => 'status.store']) }}
                @include('task_status.form')
                <div class="mt-2">
                    {{ Form::submit('Создать', ['class' => 'btn btn-secondary mb-3']) }}
                </div>
                {{ Form::close() }}

            </div>
@endsection
