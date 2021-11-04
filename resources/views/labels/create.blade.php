@extends('layouts.app')

@section('content')

<h1 class="mb-5">Создать метку</h1>
{{ Form::model($label, ['url' => route('labels.store'), 'class' => "w-50"]) }}
@include('labels.form')
{{ Form::submit('Создать', ['class' => "btn btn-primary"]) }}
{{ Form::close() }}

@endsection
