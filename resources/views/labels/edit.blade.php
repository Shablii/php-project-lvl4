@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('Change label')}}</h1>
{{ Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => "w-50"]) }}
@include('labels.form')
{{ Form::submit(__('Edit'), ['class' => "btn btn-primary"]) }}
{{ Form::close() }}
@endsection
