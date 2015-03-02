<html>
    <head>
        <meta charset="UTF-8">
        <title>Accounting Book</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="/css/bootstrap.min.css"/>-->
        <link rel="stylesheet" href="/css/style.css"/>
    </head>
    <body>
        <div id="container" class="container-fluid">
            @section('header')
            <div data-spy="affix" id="sidebar-container" class="col-xs-8 col-sm-3 col-md-2 hidden-xs">
                <div id="sidebar" class="col-sm-12">
                    <h2 id="site-tittle"><a href="/">Accounting Book</a></h2>
                    <nav>
                        <ul id="menu-nav" class="nav nav-pills nav-stacked">
                            <li role="presentation"><a href="/dashboard"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Dashboard</a></li>
                            <li role="presentation"><a href="/earnings"><span class="glyphicon glyphicon-plus-sign"></span> Ingresos</a></li>
                            <li role="presentation"><a href="/expenses"><span class="glyphicon glyphicon-minus-sign"></span> Egresos</a></li>
                            <li role="presentation"><a href="/savings"><span class="glyphicon glyphicon-piggy-bank"></span> Ahorros</a></li>
                            <li role="presentation"><a href="/budget"><span class="glyphicon glyphicon-blackboard"></span> Presupuesto</a></li>
                            <li role="presentation"><a href="/categories/earnings"><span class="glyphicon glyphicon-tasks"></span> Categorías de Ingresos</a></li>
                            <li role="presentation"><a href="/categories/expenses"><span class="glyphicon glyphicon-tasks"></span> Categorías de Gastos</a></li>
                            <li role="presentation"><a href="/auth/logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div data-spy="affix" id="sidebar-button" class="visible-xs-block">
                <button id="buttontoggle" type="button" class="btn btn-primary" onclick="toggleSidebar()">
                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                </button>
            </div>
            @show
            <div id="content-container" class="col-sm-9 col-sm-offset-3 col-md-offset-2 col-md-10 ">
                @yield('content')
            </div>
            <footer>
                <div class="contentfooter">
                    @yield('footer')
                </div>
            </footer>
        </div>
        <script src="/js/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <!--<script src="/js/bootstrap.min.js"></script>-->
        <script>
                    function toggleSidebar() {
                        if ($('#sidebar-container').hasClass('hidden-xs')) {
                            $('#sidebar-container').removeClass('hidden-xs');
                            $('#sidebar-button').addClass('col-xs-offset-8');
                        } else {
                            $('#sidebar-container').addClass('hidden-xs');
                            $('#sidebar-button').removeClass('col-xs-offset-8');
                        }
                    }
        </script>
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover();
            });
        </script>
    </body>
</html>