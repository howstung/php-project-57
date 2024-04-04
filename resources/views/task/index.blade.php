<x-app-layout>
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
            <tr class="tl-local">
                <td>{{ __('views.task.table.id') }}</td>
                <td>{{ __('views.task.table.status') }}</td>
                <td>{{ __('views.task.table.name') }}</td>
                <td>{{ __('views.task.table.author') }}</td>
                <td>{{ __('views.task.table.executor') }}</td>
                <td>{{ __('views.task.table.created_at') }}</td>

                @auth
                    <td>{{ __('views.task.table.actions') }}</td>
                @endauth
            </tr>
            </thead>
            <tbody>

            @foreach ($tasks as $task)

                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td><a href="{{ route('task.show', $task->id) }}"
                           style="text-decoration: none">{{ $task->name }}</a></td>
                    <td>{{ $task->author->name ?? null }}</td>
                    <td>{{ $task->executor->name ?? null }}</td>
                    <td>{{ $task->getCreatedAt() }}</td>

                    @auth
                        <td style="min-width: 100px;">

                            @include('parts.input_edit', [
                                'title' => __('views.task.pages.index.edit'),
                                'route' => route('task.edit', $task->id)
                                ]
                            )

                            @if($task->author->id === Auth::user()->id)
                                {{--@include('parts.modal_delete', ['model' => 'task'])--}}
                                @include('parts.modal_delete_simple', ['model' => 'task'])
                            @endif
                        </td>
                    @endauth
                </tr>
            @endforeach

            </tbody>
        </table>

        <!-- Pagination -->
        {{--@include('task.pagination')--}}

    </div>
</x-app-layout>
