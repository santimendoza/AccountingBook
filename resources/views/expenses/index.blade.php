@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <a href="/expenses/create" class="btn btn-success">Agregar gasto</a>
        </div>
        <h1>Lista de gastos</h1>
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
                @foreach($expenses as $expense)
                <tr>
                    <td>{{$expense->date}}</td>
                    <td>{{$expense->amount}}</td>
                    <td>{{$expense->description}}</td>
                    <td>{{$expense->expensescategories->slug}}</td>
                    <td>
                        <form id="delete-earning" action="/expenses/{{$expense->id}}" method="POST" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                            <a href="/expenses/{{$expense->id}}/edit" class="btn btn-info">Editar</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop