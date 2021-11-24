@extends('layouts.app')

@section('content')

@include('flash::message')

<h1 class="mb-5">Задачи</h1>
<div class="d-flex">
    <div>
        @include('tasks.searchForm')
    </div>
    @if(Auth::check())
    <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">Создать задачу</a>
    @endif
</div>
<table class="table mt-2">
    <thead>
    <tr>
        <th>ID</th>
        <th>Статус</th>
        <th>Имя</th>
        <th>Автор</th>
        <th>Исполнитель</th>
        <th>Дата создания</th>
        @auth
        <th>Действия</th>
        @endauth
    </tr>
    </thead>
    @foreach($tasks as $task)
    <tr>
        <td>{{ $task->id }}</td>
        <td>{{ $task->status->name }}</td>
        <td> <a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a> </td>
        <td>{{ $task->createdBy->name }}</td>
        <td>{{ $task->assignedTo?->name }}</td>
        <td>{{ $task->created_at->format('d.m.Y') }}</td>
        @auth
        <td>
            @can('delete', $task)
            <a href="{{ route('tasks.destroy', $task->id) }}"
               data-method="delete"
               data-confirm="Вы уверены?"
               class="text-danger">Удалить</a>
            @endcan
            <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
        </td>
        @endauth
    </tr>
    @endforeach
</table>
{{ $tasks->links() }}
@endsection
