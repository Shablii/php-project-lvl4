@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">{{__('Hello')}}!</h1>
        <p class="lead">{{__('Task manager')}}</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="https://github.com/Shablii/php-project-lvl4" role="button">{{__(('Link to gitHab'))}}</a>
    </div>
</div>
@endsection
