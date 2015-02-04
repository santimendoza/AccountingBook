@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Crear categoria</h1>
    </div>
    @if($errors->first() != null)
    <div class="alert alert-info" role="alert">
        {{ $errors->first() }}
    </div>
    @endif
    {{ Form::open(array('action' => 'CategoriesController@store', 'method' => 'post')) }}
    <div class="form-group">
        {{ Form::label('slug', 'Nombre:', array('class' => 'awesome')) }}
        {{ Form::text('slug' , null, array('class' => 'form-control', 'required')) }}
    </div>
    <div class="form-group">
        <label>Categoría superior (opcional)</label>
        @if(count($categories) >= 1)
        <select name="superior_cat" id="superior_cat" class="form-control">
            <option value="-1">Ninguna</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->slug}}</option>
            @endforeach
        </select>
        @endif
    </div>
    <div class="form-group">
        <label>Tipo de categoría:</label>
        <select name="type" id="type" class="form-control">
            <option value="0">Ingresos</option>
            <option value="1">Egresos</option>
        </select>
    </div>
    <div class="form-group">
        {{ Form::submit('Crear', array('class' => 'btn btn-info')) }}
        <a href="/categories" class="btn btn-danger">Regresar</a>
    </div>
    {{ Form::close() }} 
</div>

@stop