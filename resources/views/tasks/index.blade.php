@extends('layouts.app')

@section('content')

@include('flash::message')

<h1 class="mb-5">{{__('Tasks')}}</h1>
<div class="d-flex">
    <div>
        @include('tasks.searchForm')
    </div>
    @auth
    <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">{{__('Create task')}}</a>
    @endauth
</div>
<table class="table mt-2">
    <thead>
    <tr>
        <th>{{__('ID')}}</th>
        <th>{{__('Status')}}</th>
        <th>{{__('Name')}}</th>
        <th>{{__('Author')}}</th>
        <th>{{__('Assigned')}}</th>
        <th>{{__('Date of creation')}}</th>
        @auth
            <th>{{__('Actions')}}</th>
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
            <a href="{{ route('tasks.destroy', $task) }}"
               data-method="delete"
               data-confirm="{{__('Are you sure?')}}"
               class="text-danger">Удалить</a>
            @endcan
            <a href="{{ route('tasks.edit', $task) }}">{{__('Change')}}</a>
        </td>
        @endauth
    </tr>
    @endforeach
</table>
{{ $tasks->links() }}
@endsection
