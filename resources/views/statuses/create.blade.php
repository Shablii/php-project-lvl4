@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{__('Create status')}}</h1>
    {{ Form::model($status, ['url' => route('task_statuses.store'), 'class' => "w-50"]) }}
    @csrf
    <div class="form-group">
        {{ Form::label('name', __('Name')) }}<br>
        {{ Form::text('name', null, ['class' => count($errors->all()) == 0 ? 'form-control' : 'form-control is-invalid']) }}
        @foreach ($errors->all() as $error)
            <div class="invalid-feedback">{{ $error }}</div>
        @endforeach
    </div>
    {{ Form::submit(__('Create'), ['class' => "btn btn-primary"]) }}
    {{ Form::close() }}
@endsection
