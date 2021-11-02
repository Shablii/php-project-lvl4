@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Изменение статуса</h1>
    {{ Form::model($status, ['url' => route('task_statuses.update', $status), 'method' => 'PATCH', 'class' => "w-50"]) }}
    <div class="form-group">
        {{ Form::label('name', 'Имя') }}<br>
        {{ Form::text('name', null, ['class' => count($errors->all()) == 0 ? 'form-control' : 'form-control is-invalid']) }}
        @foreach ($errors->all() as $error)
            <div class="invalid-feedback">{{ $error }}</div>
        @endforeach
    </div>
    {{ Form::submit('Обновить', ['class' => "btn btn-primary"]) }}
    {{ Form::close() }}
@endsection
