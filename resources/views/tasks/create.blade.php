@extends('layouts.app')

@section('content')

<h1 class="mb-5">Создать задачу</h1>
{{ Form::model($task, ['url' => route('tasks.store'), 'class' => "w-50"]) }}
@include('tasks.form')
{{ Form::submit('Создать', ['class' => "btn btn-primary"]) }}
{{ Form::close() }}
@endsection
