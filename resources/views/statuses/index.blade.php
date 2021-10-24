@extends('layouts.app')

@section('content')

@include('flash::message')

    <h1 class="mb-5">Статусы</h1>
    <a href="{{ route('task_statuses.create') }}" class="btn btn-primary"> Создать статус</a>
    <table class="table mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tr>
            <td>133</td>
            <td>протестировано и завершено</td>
            <td>16.10.2021</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/133"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/133/edit">
                    Изменить                        </a>
            </td>
        </tr>
        <tr>
            <td>134</td>
            <td>2</td>
            <td>16.10.2021</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/134"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/134/edit">
                    Изменить                        </a>
            </td>
        </tr>
        <tr>
            <td>89</td>
            <td>В работе</td>
            <td>24.04.2021</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/89"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/89/edit">
                    Изменить                        </a>
            </td>
        </tr>
        <tr>
            <td>90</td>
            <td>Выполняется</td>
            <td>24.04.2021</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/90"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/90/edit">
                    Изменить                        </a>
            </td>
        </tr>
        <tr>
            <td>91</td>
            <td>Отменен</td>
            <td>24.04.2021</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/91"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/91/edit">
                    Изменить                        </a>
            </td>
        </tr>
        <tr>
            <td>93</td>
            <td>Тестируется</td>
            <td>24.04.2021</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/93"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/93/edit">
                    Изменить                        </a>
            </td>
        </tr>
        <tr>
            <td>94</td>
            <td>TEST!!!</td>
            <td>24.04.2021</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/94"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/94/edit">
                    Изменить                        </a>
            </td>
        </tr>
        <tr>
            <td>114</td>
            <td>303030303030</td>
            <td>12.08.2021</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/114"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/114/edit">
                    Изменить                        </a>
            </td>
        </tr>
        <tr>
            <td>35</td>
            <td>more statuses1</td>
            <td>30.09.2020</td>
            <td>
                <a
                    class="text-danger"
                    href="https://php-l4-task-manager.herokuapp.com/task_statuses/35"
                    data-confirm="Вы уверены?"
                    data-method="delete"
                >
                    Удалить                        </a>
                <a href="https://php-l4-task-manager.herokuapp.com/task_statuses/35/edit">
                    Изменить                        </a>
            </td>
        </tr>
    </table>
    <nav>
        <ul class="pagination">
            <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
            <li class="page-item"><a class="page-link" href="https://php-l4-task-manager.herokuapp.com/task_statuses?page=2">2</a></li>
            <li class="page-item"><a class="page-link" href="https://php-l4-task-manager.herokuapp.com/task_statuses?page=3">3</a></li>
            <li class="page-item">
                <a class="page-link" href="https://php-l4-task-manager.herokuapp.com/task_statuses?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
            </li>
        </ul>
    </nav>
@endsection
