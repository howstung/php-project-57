@extends('layouts.app')

@section('content')
            <div class="container">

                <h1>{{ __('views.task_status.pages.index.title') }}</h1>

                @include('flash::message')

                @auth
                    <div>
                        <a href="{{ route('status.create') }}"
                           class="btn btn-secondary">
                            {{ __('views.task_status.pages.index.new') }} </a>
                    </div>
                @endauth

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('views.task_status.table.id') }}</th>
                        <th scope="col">{{ __('views.task_status.table.name') }}</th>
                        <th scope="col">{{ __('views.task_status.table.created_at') }}</th>
                        @auth
                            <th scope="col">{{ __('views.task_status.table.actions') }}</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($statuses as $status)

                        <tr>
                            <th scope="row">{{ $status->id }}</th>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->created_at?$status->created_at->format('d.m.Y'):"" }}</td>

                            @auth
                                <td>

                                @include('parts.input_edit', ['title' => __('views.task_status.pages.index.edit'),'route' => route('status.edit', $status->id)]
)
                                @include('parts.modal_delete', [
                                    'labelName'=>'TaskStatus',
                                    'modal_id'=>$status->id,
                                    'buttonTitle' => __('views.task_status.modal.delete'),
                                    'modalHeader'=>__('views.task_status.modal.sure'),
                                    'modalBody'=> __('views.task_status.modal.will_be_deleted') .': '.  $status->name,
                                    'modalCancel'=>__('views.task_status.modal.cancel'),
                                    'modalOK'=>__('views.task_status.modal.ok'),
                                    'form'=>[
                                        'model'=>$status,
                                        'route'=>['route' => ['status.destroy', $status], 'method'=>'DELETE']
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
