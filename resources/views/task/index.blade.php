@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Задачи</h1>

        @include('flash::message')

        @include('task.filter')

        @auth
            <div>
                <a href="{{ route('task.create') }}"
                   class="btn btn-secondary">
                    Создать задачу </a>
            </div>
        @endauth

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Статус</th>
                <th scope="col">Имя</th>
                <th scope="col">Автор</th>
                <th scope="col">Исполнитель</th>
                <th scope="col">Дата создания</th>

                @auth
                    <th scope="col">Действия</th>
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
                            <a class="link-primary" href="{{route('task.edit', $task->id)}}"
                               style="text-decoration: none; cursor:pointer;">
                                <i class="bi bi-pen-fill"></i>Изменить
                            </a>

                            @if($task->author->id === Auth::user()->id)
                                <a class="link-danger" style="text-decoration: none; cursor:pointer;"
                                   data-bs-toggle="modal" data-bs-target="#example{{ $task->id }}Modal">
                                    <i class="bi bi-trash-fill"></i>Удалить
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="example{{ $task->id }}Modal" tabindex="-1"
                                     aria-labelledby="example{{ $task->id }}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="example{{ $task->id }}ModalLabel">Вы
                                                    уверены ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Будет удалена задача: {{ $task->name }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Отмена
                                                </button>

                                                {{ Form::model($task, ['route' => ['task.destroy', $task], 'method'=>'DELETE']) }}
                                                {{ Form::submit('OK', ['class' => 'btn btn-success']) }}
                                                {{ Form::close() }}

                                            </div>
                                        </div>
                                    </div>
                                </div>
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
