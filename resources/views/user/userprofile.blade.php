@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>{{ $user->name }} {{ $user->lastname }}
            <small>
                {{ $user->username }}
            </small>
        </h1>
    </div>
</div>

@stop