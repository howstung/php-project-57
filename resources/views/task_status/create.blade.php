@extends('layouts.app')

@section('content')

    @include('parts.form_wrapper_create_edit', [
        'h1' => __('views.task_status.pages.create.title'),
        'model' => $status,
        'route' => ['route' => 'status.store'],
        'includeForm' => 'task_status.form',
        'submit'=> __('views.task_status.pages.create.submit')
    ])

@endsection
