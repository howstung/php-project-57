<header>

    <nav class="navbar navbar-expand-md bg-body-tertiary shadow fixed-top">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">Менеджер задач</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('welcome')?'active':null }}" aria-current="page" href="{{ route('welcome') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('task.*')?'active':null }}" aria-current="page" href="{{ route('task.index') }}">Задачи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('status.*')?'active':null }}" href="{{ route('status.index') }}">Статусы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('label.*')?'active':null }}" href="{{ route('label.index') }}">Метки</a>
                    </li>
                </ul>


                @auth

                    <style>

                    </style>
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" style="text-decoration: none;"
                               href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img style="width: 40px"
                                     src="{{ route('welcome') }}/img/user_default.png" class="avatar" alt="Avatar"> {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
    {{--                            <li><a href="#" class="dropdown-item"><i class="bi bi-person-fill"></i> Profile</a></li>
                                <li><a href="#" class="dropdown-item"><i class="bi bi-calendar-check"></i> Calendar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="#" class="dropdown-item"><i class="bi bi-gear"></i> Settings</a></li>
                                <li><hr class="dropdown-divider"></li>--}}

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Выход
                                    </button>
                                </form>

                                {{--<a href="#" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Выход</a>--}}
                            </ul>
                        </li>
                    </ul>


                    {{--<a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>--}}
{{--                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            {{ __('Выход') }}
                        </button>
                    </form>--}}

                @else
                    <a class="btn btn-outline-secondary" href="{{ route('login') }}">Вход</a>

                    @if (Route::has('register'))
                        <a class="btn btn-outline-secondary" href="{{ url('/') }}/register">Регистрация</a>
                    @endif
                @endauth

            </div>
        </div>
    </nav>
</header>
