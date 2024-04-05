<header>

    <nav class="navbar navbar-expand-md bg-body-tertiary shadow fixed-top">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">{{ __('main.title') }}</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Navigation toggle">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('welcome')?'active':null }}" aria-current="page" href="{{ route('welcome') }}">{{ __('main.menu.items.main') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('task.*')?'active':null }}" aria-current="page" href="{{ route('task.index') }}">{{ __('main.menu.items.tasks') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('status.*')?'active':null }}" href="{{ route('task_status.index') }}">{{ __('main.menu.items.task_statuses') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('label.*')?'active':null }}" href="{{ route('label.index') }}">{{ __('main.menu.items.labels') }}</a>
                    </li>
                </ul>


                @auth

                    <!-- Simple -->
{{--                    <div style="color: gray; margin-right: 10px; cursor: inherit; "
                      role="button">
                        <img style="width: 40px"
                             src="{{ url('/') }}/img/user_default.png" class="avatar" alt="Avatar"> {{ Auth::user()->name }}
                    </div>--}}

                    <ul class="nav" style="margin-right: 20px;">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" style="text-decoration: none;"
                               href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img style="width: 40px"
                                     src="{{ url('/') }}/img/user_default.png" class="avatar" alt="Avatar"> {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                               <li><a href="{{ route('profile.edit') }}" class="dropdown-item"><i class="bi bi-person-fill"></i>
                                   {{ __('main.menu.profile.profile') }}</a></li>

                                {{--<li><a href="#" class="dropdown-item"><i class="bi bi-calendar-check"></i> Calendar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="#" class="dropdown-item"><i class="bi bi-gear"></i> Settings</a></li>
                                <li><hr class="dropdown-divider"></li>--}}

{{--                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn btn-outline-secondary">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('main.menu.profile.logout') }}
                                    </button>
                                </form>--}}

                                {{--<a href="#" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Выход</a>--}}
                            </ul>
                        </li>
                    </ul>

                    {{--<a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>--}}

                    {{ Form::model(null, ['route' => ['logout'], 'method' => 'POST']) }}
                        {{--<x-b.input-submit name="{{ __('main.menu.profile.logout') }}" class="btn btn-outline-secondary"/>--}}
                        <a href="{{ route('logout') }}" class="btn btn-outline-secondary"
                           onclick="event.preventDefault(); this.closest('form').submit()">
                            {{ __('main.menu.profile.logout') }}
                        </a>
                    {{ Form::close() }}

                @else
                    <a class="btn btn-outline-secondary" href="{{ route('login') }}">{{ __('main.menu.profile.login') }}</a>

                    @if (Route::has('register'))
                        <a class="btn btn-outline-secondary" href="{{ route('register') }}">{{ __('main.menu.profile.register') }}</a>
                    @endif
                @endauth

            </div>
        </div>
    </nav>
</header>
