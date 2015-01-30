@extends('templates.master')
@section('header')
@parent
@stop
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="page-header">
                <h1>{{ Auth::user()->name }} {{ Auth::user()->lastname }}
                    <small>
                        {{ Auth::user()->username }}
                    </small>
                </h1>
            </div>
        </div>
    </div>
</div>


@stop