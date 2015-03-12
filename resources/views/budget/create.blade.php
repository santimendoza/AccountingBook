@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Presupuesto <small>Total: {{$totalBudget}}</small></h1>
    </div>
    <div class="col-sm-12">
        @if($errors->budgetError->first() != null)
        <div class="alert alert-danger" role="alert">
            {{ $errors->budgetError->first() }}
        </div>
        @endif
        <h2>Gastos</h2>
        <div class="row">
            @foreach($categories[0] as $categorysup)
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="list-group">
                    <div class="list-group-item active">
                        <h4 class="list-group-item-heading">{{$categorysup->slug}}</h4>
                        <form action="/budget" class="form" method="POST" class="form" accept-charset="UTF-8">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input class="form-control" type="hidden" id="id" name="id" value="{{$categorysup->id}}" hidden/>
                            </div>
                            <div class="form-group">
                                <label for="budget">Presupuesto para {{$categorysup->slug}}:</label>
                                <input class="form-control" type="text" pattern="[0-9]*(|.[0-9]+)" id="budget" value="{{$categorysup->budget}}" name="budget" placeholder="Presupuesto"/>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="Guardar"/>
                            </div>
                        </form>
                    </div>
                    @foreach($categories[1] as $categoryinf)
                    @foreach($categoryinf as $category)
                    @if($category->superior_cat == $categorysup->id)
                    <div class="list-group-item">
                        <form action="/budget" class="form" method="POST" class="form" accept-charset="UTF-8">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input class="form-control" type="hidden" id="id" name="id" value="{{$category->id}}" hidden/>
                            </div>
                            <div class="form-group">
                                <label for="budget">Presupuesto para {{$category->slug}}:</label>
                                <input class="form-control" type="text" pattern="[0-9]*(|.[0-9]+)" id="budget" value="{{$category->budget}}" name="budget" placeholder="Presupuesto"/>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="Guardar"/>
                            </div>
                        </form>
                    </div>
                    @endif
                    @endforeach
                    @endforeach

                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <h2>Ahorros</h2>
            @foreach($savings as $saving)
            <div class="col-xs-12 col-sm-4">
                <div class="list-group">
                    <div class="list-group-item active">
                        <h4 class="list-group-item-heading">{{$saving->title}}</h4>
                        <form action="/budget/savings-budget" class="form" method="POST" class="form" accept-charset="UTF-8">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input class="form-control" type="hidden" id="id" name="id" value="{{$saving->id}}" hidden/>
                            </div>
                            <div class="form-group">
                                <label for="budget">Presupuesto para {{$saving->title}}:</label>
                                <input class="form-control" type="text" pattern="[0-9]*(|.[0-9]+)" id="budget" value="{{$saving->budget}}" name="budget" placeholder="Presupuesto"/>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="Guardar"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@stop