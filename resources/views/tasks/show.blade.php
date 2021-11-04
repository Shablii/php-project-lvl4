@extends('layouts.app')

@section('content')

<h1 class="mb-5">
    Просмотр задачи: {{ $task->id }}
    <a href="{{ route('tasks.edit', $task->id) }}">&#9881;</a>
</h1>
<p>Имя: {{ $task->name }}</p>
<p>Статус: {{ $task->status->name }}</p>
<p>Описание:{{ $task->description }}</p>
<p>Метки:</p>
<ul>
    @foreach($task->labels as $label)
    <li>{{ $label->name }}</li>
    @endforeach
</ul>
@endsection
