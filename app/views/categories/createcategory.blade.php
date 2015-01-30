@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Crear categoria</h1>
    </div>
    {{ Form::open(array('action' => 'CategoriesController@store', 'method' => 'post')) }}
    <div class="form-group">
        {{ Form::label('slug', 'Nombre:', array('class' => 'awesome')) }}
        {{ Form::text('slug' , null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        @if(count($categories) > 1)
        <select name="superior_cat" id="superior_cat" class="form-control">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->slug}}</option>
            @endforeach
        </select>
        @endif
    </div>
    <div class="form-group">
        <select name="type" id="type" class="form-control">
            <option value="0">Ingresos</option>
            <option value="1">Egresos</option>
        </select>
    </div>
    @if($errors->first() != null)
    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
    </div>
    @endif
    <div class="form-group">
        {{ Form::submit('Login', array('class' => 'form-control btn btn-info')) }}
    </div>
    {{ Form::close() }} 
</div>

@stop