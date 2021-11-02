@extends('layouts.app')

@section('content')

<h1 class="mb-5">Создать задачу</h1>
{{ Form::model($task, ['url' => route('tasks.store'), 'class' => "w-50"]) }}
<div class="form-group">

    <div class="form-group">
    {{ Form::label('name', 'Имя') }}
    {{ Form::text('name', null, ['class' => $errors->first('name') == null ? 'form-control' : 'form-control is-invalid']) }}
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    </div>

    <div class="form-group">
    {{ Form::label('description', 'Описание') }}
    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
    {{ Form::label('status_id', 'Статус') }}
    {{ Form::select('status_id', $statuses, '', ['class' => $errors->first('status_id') == null ? 'form-control' : 'form-control is-invalid']) }}
        <div class="invalid-feedback">{{ $errors->first('status_id') }}</div>
    </div>

    <div class="form-group">
    {{ Form::label('assigned_to_id', 'Исполнитель') }}
    {{ Form::select('assigned_to_id', $users,'', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
    {{ Form::label('1', 'Метки') }}
    {{ Form::select('1', ['def' => '----------', 't2' => 'test', 't' => 'test2'], null, ['class' => 'form-control', 'multiple']) }}
    </div>
</div>
{{ Form::submit('Создать', ['class' => "btn btn-primary"]) }}
{{ Form::close() }}

@endsection
