@extends('layouts.app')

@section('content')

    @include('flash::message')

    <h1 class="mb-5">Метки</h1>
    @if(Auth::check())
    <a href="{{ route('labels.create') }}" class="btn btn-primary">Создать метку</a>
    @endif
    <table class="table mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Описание</th>
            <th>Дата создания</th>
            @if(Auth::check())
            <th>Действия</th>
            @endif
        </tr>
        </thead>
        @foreach($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->created_at->format('d.m.Y') }}</td>
                @if(Auth::check())
                <td>
                            <a href="{{ route('labels.destroy', $label->id) }}"
                               data-method="delete"
                               data-confirm="Вы уверены?"
                               class="text-danger">Удалить</a>
                        <a href="{{ route('labels.edit', $label->id) }}">Изменить</a>
                </td>
                @endif
            </tr>
        @endforeach
    </table>
    {{ $labels->links() }}
@endsection
