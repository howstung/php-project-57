@extends('layouts.app')

@section('content')

    @include('parts.form_wrapper_create_edit', [
        'h1' => __('views.task.pages.edit.title'),
        'model' => $task,
        'route' => ['route' => ['task.update', $task], 'method' => 'PATCH'],
        'includeForm' => 'task.form',
        'submit'=> __('views.task.pages.edit.submit')
    ])

@endsection
