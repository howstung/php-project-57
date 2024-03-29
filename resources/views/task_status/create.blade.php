@extends('layouts.app')

@section('content')
            <h1 class="mb-5">Создать статус</h1>

            <div class="col-xl-3 col-lg-4 col-sm-6">

                {{ Form::model($status, ['route' => 'status.store']) }}

                @include('task_status.form')

                {{ Form::submit('Создать', ['class' => 'btn btn-secondary mt-3 mb-3']) }}
                {{ Form::close() }}

            </div>
@endsection
