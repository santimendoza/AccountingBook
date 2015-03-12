@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <a href="/categories/expenses/create" class="btn btn-success">Crear categoria</a>
        </div>
        <h1>Categorías de Gastos</h1>
    </div>
    <div class="col-sm-12">
        @foreach($categories[0] as $categorysup)
        <div class="col-sm-3">

            <div id="piechart{{$categorysup->id}}" style="width: 300px; height: 400px;"></div>

            @foreach($categories[1] as $categoryinf)
            @foreach($categoryinf as $category)
            @if($categorysup->superior_cat == $categorysup->id)
            <div id="piechart{{$categoryinf->id}}" style="width: 300px; height: 400px;"></div>
            @endif
            @endforeach
            @endforeach

        </div>
        @endforeach
    </div>
</div>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
            @if ($categories != null)
            google.setOnLoadCallback(drawChart);
            @endif
            
            function drawChart() {
            @foreach($categories[0] as $categorysup)
                    var data = google.visualization.arrayToDataTable([
                            ['Categoria', 'Monto'],
                            @if ( ($categorysup->budget - $categorysup->amount) < 0)
                            ['Presupuesto restante', 0],
                            @else
                            ['Presupuesto restante', {{ $categorysup->budget - $categorysup->amount }}],
                            @endif
                            ['Gastado', {{$categorysup->amount}}],
                    ]);
                    var options = {
                    title: '{{$categorysup->slug}}'
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart{{$categorysup->id}}'));
                    chart.draw(data, options);
                    @endforeach
            }
</script>
@stop

