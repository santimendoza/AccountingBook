@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <a href="/savings/create" class="btn btn-success">Agregar ahorro</a>
        </div>
        <h1>Ahorros</h1>
    </div>
    <div id="table-container" class="col-sm-12">
        <table class="table table-bordered table-hover table-condensed table-responsive">
            <thead>
                <tr>
                    <td>Saldo</td>
                    <td>Título</td>
                    <td>Descripción</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($savings as $saving)
                <tr>
                    <td>{{$saving->amount}}</td>
                    <td>{{$saving->title}}</td>
                    <td>{{$saving->description}}</td>
                    <td>
                        <form id="delete-earning" action="/savings/{{$saving->id}}" method="POST" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                            <a href="/savings/{{$saving->id}}/edit" class="btn btn-info">Editar</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop