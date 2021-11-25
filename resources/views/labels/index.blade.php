@extends('layouts.app')

@section('content')

    @include('flash::message')

    <h1 class="mb-5">Метки</h1>
    @auth
    <a href="{{ route('labels.create') }}" class="btn btn-primary">Создать метку</a>
    @endauth
    <table class="table mt-2">
        <thead>
        <tr>
            <th>{{__('ID')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Description')}}</th>
            <th>{{__('Date of creation')}}</th>
            @auth
                <th>{{__('Actions')}}</th>
            @endauth
        </tr>
        </thead>
        @foreach($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->created_at->format('d.m.Y') }}</td>
                @auth
                <td>
                    <a href="{{ route('labels.destroy', $label) }}"
                       data-method="delete"
                       data-confirm="{{__('Are you sure?')}}"
                       class="text-danger">Удалить</a>
                    <a href="{{ route('labels.edit', $label) }}">{{__('Change')}}</a>
                </td>
                @endauth
            </tr>
        @endforeach
    </table>
    {{ $labels->links() }}
@endsection
