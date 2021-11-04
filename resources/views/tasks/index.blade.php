@extends('layouts.app')

@section('content')

@include('flash::message')

<h1 class="mb-5">Задачи</h1>
<div class="d-flex">
    <div>
        @include('tasks.serchForm')
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
        @if(Auth::check())
        <th>Действия</th>
        @endif
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
        @if(Auth::check())
        <td>
                @if(Auth::id() == $task->created_by_id)
            <a href="{{ route('tasks.destroy', $task->id) }}"
               data-method="delete"
               data-confirm="Вы уверены?"
               class="text-danger">Удалить</a>
                @endif
            <a href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
        </td>
        @endif
    </tr>
    @endforeach
</table>
{{ $tasks->links() }}
@endsection
