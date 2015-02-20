@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Agregar gasto</h1>
    </div>
    <div class="col-sm-12">
        @if($savingsError != null)
        <div class="alert alert-info" role="alert">
            {{ $savingsError }}
        </div>
        @endif
        @if($errors->expensesError->first() != null)
        <div class="alert alert-info" role="alert">
            {{ $errors->expensesError->first() }}
        </div>
        @endif
        <form action="/savings/{{$savings_id}}/usedFounds" method="POST" class="form" accept-charset="UTF-8">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="amount">Monto:</label>
                <input class="form-control" type="text" pattern="[0-9]*.[0-9]+" id="amount" name="amount" placeholder="Monto"/>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <input class="form-control" type="text" id="description" name="description" placeholder="Descripción"/>
            </div>
            <div class="form-group">
                <label for="date">Fecha del gasto:</label>
                <input class="form-control" type="date" id="description" name="date" placeholder="Fecha"/>
            </div>
            <div class="form-group">
                <label for="description">Categoría:</label>
                @if($categories != null)
                <select class="form-control" name="expensesCategory_id">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->slug}}</option>
                    @endforeach
                </select>
                @endif
            </div>
            <div class="form-group">
                <input class="btn btn-success" type="submit" value="Agregar"/>
                <a href="/savings" class="btn btn-warning">Regresar</a>
            </div>
        </form>
    </div>
</div>

@stop