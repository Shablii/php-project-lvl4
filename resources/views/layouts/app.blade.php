<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Менеджер задач</title>

    <!-- Scripts -->
    <script src="https://php-l4-task-manager.herokuapp.com/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://php-l4-task-manager.herokuapp.com/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">Менеджер задач</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="https://php-l4-task-manager.herokuapp.com/tasks">
                            Задачи                            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('task_statuses.index') }}">Статусы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="https://php-l4-task-manager.herokuapp.com/labels">
                            Метки                            </a>
                    </li>
                </ul>
            @if (Route::has('login'))
                <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            @auth
                                <a href="{{ url('/home') }}" class="nav-link">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="nav-link">Вход</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Регистрация</a>
                            </li>
                        @endif
                        @endauth
                    </ul>
                @endif
            </div>
        </div>
    </nav>
    <main class="container py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
