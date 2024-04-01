@extends('layouts.app')

@section('content')

    @include('parts.form_wrapper_create_edit', [
        'h1' => __('views.task_status.pages.edit.title'),
        'model' => $status,
        'route' => ['route' => ['status.update', $status], 'method' => 'PATCH'],
        'includeForm' => 'task_status.form',
        'submit'=> __('views.task_status.pages.edit.submit')
    ])

@endsection
