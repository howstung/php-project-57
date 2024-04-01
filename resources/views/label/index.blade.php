@extends('layouts.app')

@section('content')
            <div class="container">

                <h1>{{ __('views.label.pages.index.title') }}</h1>

                @include('flash::message')

                @auth
                    <div>
                        <a href="{{ route('label.create') }}"
                           class="btn btn-secondary">
                            {{ __('views.label.pages.index.new') }} </a>
                    </div>
                @endauth

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('views.label.table.id') }}</th>
                        <th scope="col">{{ __('views.label.table.name') }}</th>
                        <th scope="col">{{ __('views.label.table.description') }}</th>
                        <th scope="col">{{ __('views.label.table.created_at') }}</th>
                        @auth
                            <th scope="col">{{ __('views.label.table.actions') }}</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($labels as $label)

                        <tr>
                            <th scope="row">{{ $label->id }}</th>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description }}</td>
                            <td>{{ $label->created_at->format('d.m.Y') }}</td>

                            @auth
                                <td>

                                @include('parts.input_edit', ['title' => __('views.label.pages.index.edit'),'route' => route('label.edit', $label->id)])

                                @include('parts.modal_delete', [
                                    'labelName'=>'Label',
                                    'modal_id'=>$label->id,
                                    'buttonTitle' => __('views.label.modal.delete'),
                                    'modalHeader'=>__('views.label.modal.sure'),
                                    'modalBody'=> __('views.label.modal.will_be_deleted') .': '.  $label->name,
                                    'modalCancel'=>__('views.label.modal.cancel'),
                                    'modalOK'=>__('views.label.modal.ok'),
                                    'form'=>[
                                        'model'=>$label,
                                        'route'=>['route' => ['label.destroy', $label], 'method'=>'DELETE']
                                    ]
                                ])

                            </td>
                            @endauth
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
@endsection
