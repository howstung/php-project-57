@extends('layouts.app')

@section('content')
            <div class="container">

                <h1>Метки</h1>

                @include('flash::message')

                @auth
                    <div>
                        <a href="{{ route('label.create') }}"
                           class="btn btn-secondary">
                            Создать метку </a>
                    </div>
                @endauth

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Дата создания</th>
                        @auth
                            <th scope="col">Действия</th>
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
                                <td style="min-width: 186px;">

                                <a class="link-danger" style="text-decoration: none; cursor:pointer;"
                                   data-bs-toggle="modal" data-bs-target="#example{{ $label->id }}Modal">
                                    <i class="bi bi-trash-fill"></i>Удалить
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="example{{ $label->id }}Modal" tabindex="-1" aria-labelledby="example{{ $label->id }}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="example{{ $label->id }}ModalLabel">Вы уверены ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Будет удалена метка: {{ $label->name }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

                                                {{ Form::model($label, ['route' => ['label.destroy', $label], 'method'=>'DELETE']) }}
                                                {{ Form::submit('OK', ['class' => 'btn btn-success']) }}
                                                {{ Form::close() }}

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a class="link-primary" href="{{route('label.edit', $label->id)}}" style="text-decoration: none; cursor:pointer;">
                                    <i class="bi bi-pen-fill"></i>Изменить
                                </a>

                            </td>
                            @endauth
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
@endsection
