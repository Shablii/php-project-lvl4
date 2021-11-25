@extends('layouts.app')

@section('content')

@include('flash::message')

    <h1 class="mb-5">{{__('Statuses')}}</h1>
    @auth
    <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">Создать статус</a>
    @endauth
    <table class="table mt-2">
        <thead>
        <tr>
            <th>{{__('ID')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Date of creation')}}</th>
            @auth
                <th>{{__('Actions')}}</th>
            @endauth
        </tr>
        </thead>
        @foreach($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at->format('d.m.Y') }}</td>
                @auth
                <td>
                    <a href="{{ route('task_statuses.destroy', $status) }}"
                       data-method="delete"
                       data-confirm="{{__('Are you sure?')}}"
                       class="text-danger">Удалить</a>
                    <a href="{{ route('task_statuses.edit', $status) }}">{{__('Change')}}</a>
                </td>
                @endauth
            </tr>
        @endforeach
    </table>
    {{ $statuses->links() }}
@endsection
