@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        @if(!$hasSubcategories)
        <form class="pull-right" method="POST" action="/categories/earnings/{{$category->id}}">
            <input name="_method" type="hidden" value="DELETE">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-danger" value="Eliminar">
        </form>
        @endif
        <h1>Editar categoría {{$category->slug}}</h1>
    </div>
    <form method="POST" action="/categories/earnings/{{$category->id}}" accept-charset="UTF-8">
        <input name="_method" type="hidden" value="PUT">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="slug" class="awesome">Nombre:</label>
            <input class="form-control" required="required" name="slug" type="text" value="{{$category->slug}}" id="slug">
        </div>
        <div class="form-group">
            @if(count($categories) >= 1 && !$hasSubcategories)
            <label >Categoría superior (opcional)</label>

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
        <!--        <div class="form-group">
                    <label>Tipo de categoría:</label>
                    <select name="type" id="type" class="form-control">
                        <option value="0">Ingresos</option>
                        <option value="1">Egresos</option>
                    </select>
                </div>-->
        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Crear">
            <a href="/categories/earnings" class="btn btn-warning">Regresar</a>
        </div>
    </form>
</div>
<script>
//    $(document).ready(function() {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //});
</script>
@stop