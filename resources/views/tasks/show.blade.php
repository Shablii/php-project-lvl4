@extends('layouts.app')

@section('content')

<h1 class="mb-5">
    {{__('View a task')}}: {{ $task->id }}
    <a href="{{ route('tasks.edit', $task->id) }}">&#9881;</a>
</h1>
<p>{{__(('Name'))}}: {{ $task->name }}</p>
<p>{{__(('Status'))}}: {{ $task->status->name }}</p>
<p>{{__(('Description'))}}:{{ $task->description }}</p>
<p>{{__(('Labels'))}}:</p>
<ul>
    @foreach($task->labels as $label)
    <li>{{ $label->name }}</li>
    @endforeach
</ul>
@endsection
