@extends('layouts.app')

@section('content')
            <h1 class="mb-5">Создать метку</h1>

            <div class="col-xl-3 col-lg-4 col-sm-6">

                {{ Form::model($label, ['route' => 'label.store']) }}

                @include('label.form')

                {{ Form::submit('Создать', ['class' => 'btn btn-secondary mt-3 mb-3']) }}
                {{ Form::close() }}

            </div>
@endsection
