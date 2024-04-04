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

                    @foreach ($task_statuses as $task_status)

                        <tr>
                            <th scope="row">{{ $task_status->id }}</th>
                            <td>{{ $task_status->name }}</td>
                            <td>{{ $task_status->getCreatedAt() }}</td>

                            @auth
                            <td>
                                @include('parts.input_edit', ['title' => __('views.task_status.pages.index.edit'),'route' => route('task_status.edit', $task_status->id)])

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
