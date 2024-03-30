@extends('layouts.app')

@section('content')
    <h3 class="mb-5">Просмотр задачи

        @auth
        <a class="link-primary" href="{{ route('task.edit', $task->id) }}" style="text-decoration: none; cursor:pointer;">
            <i class="bi bi-pen-fill"></i>
        </a>
        @endauth

    </h3>

    <div class="col-md-6">

        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <p><span class="p-task-item">Имя:</span> {{ $task->name }}</p>
                </li>
                <li class="list-group-item">
                    <p><span class="p-task-item">Статус:</span> {{ $task->status->name }}</p>
                </li>
                <li class="list-group-item">
                    <p><span class="p-task-item">Описание:</span> {{ $task->description }}</p>
                </li>
                <li class="list-group-item">
                    <p><span class="p-task-item">Метки:</span>



                        @foreach ($task->labels as $label)
                            <span class="badge rounded-pill bg-primary" style="padding: 8px 12px 8px 8px; margin-top: 10px;">
                                <svg style="width: 15px" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>

                               <span style="font-size: 14px;"> {{ $label->name }}</span></span>
                        @endforeach

                    </p>
                </li>
            </ul>

        </div>

        <style>
            .p-task-item{
                font-weight: bold;
            }
        </style>

    </div>
@endsection
