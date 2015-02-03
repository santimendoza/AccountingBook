@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <button data-toggle="tooltip" data-placement="top" title="Tooltip on left" class="btn btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Ayuda</button>
        </div>

        <h1>Editar categoría {{$category->slug}}</h1>

    </div>
    {{ Form::open(array('action' => 'CategoriesController@store', 'method' => 'post')) }}
    <div class="form-group">
        {{ Form::label('slug', 'Nombre:', array('class' => 'awesome')) }}
        {{ Form::text('slug' , $category->slug, array('class' => 'form-control', 'required')) }}
    </div>
    <div class="form-group">
        <label >Categoría superior (opcional)</label>
        @if(count($categories) >= 1)
        <select name="superior_cat" id="superior_cat" class="form-control">
            <option value="-1">Ninguna</option>
            @foreach($categories as $categoria)
            @if($categoria->id != $category->id)
            <option value="{{$categoria->id}}">{{$categoria->slug}}</option>
            @endif
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
        {{ Form::submit('Crear', array('class' => 'btn btn-success')) }}
        <a href="/categories" class="btn btn-danger">Regresar</a>
    </div>
    {{ Form::close() }}
</div>
<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>
<script>
//    $(document).ready(function() {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    //});
</script>
@stop