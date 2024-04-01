@extends('layouts.app')

@section('content')

    @include('parts.form_wrapper_create_edit', [
        'h1' => __('views.label.pages.edit.title'),
        'model' => $label,
        'route' => ['route' => ['label.update', $label], 'method' => 'PATCH'],
        'includeForm' => 'label.form',
        'submit'=> __('views.label.pages.edit.submit')
    ])

@endsection
