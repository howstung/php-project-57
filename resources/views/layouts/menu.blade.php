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
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('/') }}/tasks">Задачи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}/task_statuses">Статусы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}/labels">Метки</a>
                    </li>
                </ul>

                <div>
                    @auth
                        {{--<a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>--}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary">
                                {{ __('Выход') }}
                            </button>
                        </form>
                    @else
                        <a class="btn btn-outline-secondary" href="{{ route('login') }}">Вход</a>

                        @if (Route::has('register'))
                            <a class="btn btn-outline-secondary" href="{{ url('/') }}/register">Регистрация</a>
                        @endif
                    @endauth
                </div>

            </div>
        </div>
    </nav>
</header>
