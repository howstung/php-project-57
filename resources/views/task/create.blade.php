@extends('layouts.app')

@section('content')

    @include('parts.form_wrapper_create_edit', [
        'h1' => __('views.task.pages.create.title'),
        'model' => $task,
        'route' => ['route' => 'task.store'],
        'includeForm' => 'task.form',
        'submit'=> __('views.task.pages.create.submit')
    ])

@endsection
