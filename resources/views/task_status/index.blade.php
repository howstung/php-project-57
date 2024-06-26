<x-app-layout>
            <div class="container">

                <h1>{{ __('views.task_status.pages.index.title') }}</h1>

                @include('flash::message')

                @auth
                    <div>
                        <a href="{{ route('task_status.create') }}"
                           class="btn btn-secondary">
                            {{ __('views.task_status.pages.index.new') }} </a>
                    </div>
                @endauth

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr class="tl-local">
                        <td>{{ __('views.table.id') }}</td>
                        <td>{{ __('views.table.name') }}</td>
                        <td>{{ __('views.table.created_at') }}</td>
                        @auth
                            <td>{{ __('views.table.actions') }}</td>
                        @endauth
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($task_statuses as $task_status)

                        <tr>
                            <td>{{ $task_status->id }}</td>
                            <td>{{ $task_status->name }}</td>
                            <td>{{ $task_status->created_at->format('d.m.Y') }}</td>

                            @auth
                            <td>
                                @include('parts.input_edit', ['title' => __('views.submit.edit'),'route' => route('task_status.edit', $task_status->id)])

                                {{--@include('parts.modal_delete', ['model' => 'task_status'])--}}
                                @include('parts.modal_delete_simple', ['model' => 'task_status'])
                            </td>
                            @endauth
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
</x-app-layout>
