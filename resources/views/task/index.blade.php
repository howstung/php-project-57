@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>{{ __('views.task.pages.index.title') }}</h1>

        @include('flash::message')

        @include('task.filter')

        @auth
            <div>
                <a href="{{ route('task.create') }}"
                   class="btn btn-secondary">
                    {{ __('views.task.pages.index.new') }} </a>
            </div>
        @endauth

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">{{ __('views.task.table.id') }}</th>
                <th scope="col">{{ __('views.task.table.status') }}</th>
                <th scope="col">{{ __('views.task.table.name') }}</th>
                <th scope="col">{{ __('views.task.table.author') }}</th>
                <th scope="col">{{ __('views.task.table.executor') }}</th>
                <th scope="col">{{ __('views.task.table.created_at') }}</th>

                @auth
                    <th scope="col">{{ __('views.task.table.actions') }}</th>
                @endauth
            </tr>
            </thead>
            <tbody>

            @foreach ($tasks as $task)

                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->status->name }}</td>
                    <td><a href="{{ route('task.show', $task->id) }}"
                           style="text-decoration: none">{{ $task->name }}</a></td>
                    <td>{{ $task->author->name }}</td>
                    <td>{{ $task->executor->name }}</td>
                    <td>{{ $task->created_at?$task->created_at->format('d.m.Y'):"" }}</td>

                    @auth
                        <td style="min-width: 100px;">

                            @include('parts.input_edit', [
                                'title' => __('views.task.pages.index.edit'),
                                'route' => route('task.edit', $task->id)
                                ]
                            )

                            @if($task->author->id === Auth::user()->id)
                                @include('parts.modal_delete', [
                                    'labelName' => 'Task',
                                    'modal_id' => $task->id,
                                    'buttonTitle' => __('views.task.modal.delete'),
                                    'modalHeader' => __('views.task.modal.sure'),
                                    'modalBody' => __('views.task.modal.will_be_deleted') .': '.  $task->name,
                                    'modalCancel' =>__('views.task.modal.cancel'),
                                    'modalOK' => 'OK',
                                    'form' => [
                                        'model' => $task,
                                        'route' => ['route' => ['task.destroy', $task], 'method'=>'DELETE']
                                    ]
                                ])

                            @endif
                        </td>
                    @endauth
                </tr>
            @endforeach

            </tbody>
        </table>

        <!-- Pagination -->
        @include('task.pagination')

    </div>
@endsection
