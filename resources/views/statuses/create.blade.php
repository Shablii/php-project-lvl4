@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Создать статус</h1>
    {{ Form::model($status, ['url' => route('task_statuses.store'), 'class' => "w-50"]) }}
    @csrf
    <div class="form-group">
        {{ Form::label('name', 'Имя') }}<br>
        {{ Form::text('name', null, ['class' => "form-control is-invalid"]) }}
        <div class="invalid-feedback">
            text
            @include('flash::message', ['class' => "invalid-feedback"])
        </div>
    </div>
    {{ Form::submit('Создать', ['class' => "btn btn-primary"]) }}
    {{ Form::close() }}
@endsection
