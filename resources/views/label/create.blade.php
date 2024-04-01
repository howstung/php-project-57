@extends('layouts.app')

@section('content')

    @include('parts.form_wrapper_create_edit', [
        'h1' => __('views.label.pages.create.title'),
        'model' => $label,
        'route' => ['route' => 'label.store'],
        'includeForm' => 'label.form',
        'submit'=> __('views.label.pages.create.submit')
    ])

@endsection
