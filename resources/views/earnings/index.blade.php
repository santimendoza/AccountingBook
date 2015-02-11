@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <a href="/earnings/create" class="btn btn-success">Agregar ingreso</a>
        </div>
        <h1>Lista de ingresos <small>Desde {{$date1}} hasta {{$date2}}</small></h1>
    </div>
    <div id="table-container" class="col-sm-12">
        <table class="table table-bordered table-hover table-condensed table-responsive">
            <thead>
                <tr>
                    <td>Fecha</td>
                    <td>Monto</td>
                    <td>Descripción</td>
                    <td>Categoría</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($earnings as $earning)
                <tr>
                    <td>{{$earning->date}}</td>
                    <td>{{$earning->amount}}</td>
                    <td>{{$earning->description}}</td>
                    <td>{{$earning->earningscategories->slug}}</td>
                    <td>
                        <form id="delete-earning" action="/earnings/{{$earning->id}}" method="POST" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                            <a href="/earnings/{{$earning->id}}/edit" class="btn btn-info">Editar</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop