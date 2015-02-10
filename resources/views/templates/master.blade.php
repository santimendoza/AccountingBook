<html>
    <head>
        <meta charset="UTF-8">
        <title>Accounting Book</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/style.css"/>
    </head>
    <body>
        <div id="container" class="container-fluid">
            @section('header')
            <div data-spy="affix" id="sidebar-container" class="col-sm-2 hidden-xs">
                <div id="sidebar" class="col-sm-12">
                    <h2><a href="/">Accounting Book</a></h2>
                    <div id="profileinfo" class="media">
                        <div class="media-left">
                            <a href="/user">
                                <img class="media-object" src="/imgs/defaultprofile.png" alt="..." width="30px" height="30px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="/user">{{Auth::user()->name}} {{Auth::user()->lastname}}</a></h4>
                        </div>
                    </div>
                    <nav>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="/user">Dashboard</a></li>
                            <li><a href="/earnings">Ingresos</a></li>
                            <li><a href="#">Egresos</a></li>
                            <li><a href="/categories/earnings">Categorías de Ingresos</a></li>
                            <li><a href="/categories/expenses">Categorías de Gastos</a></li>
                            <li><a href="/auth/logout" class="label label-warning">Cerrar sesión</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <nav class="navbar visible-xs-inline">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-container">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="brand">AccountingBook</a>
            </nav>
            @show
            <div id="content-container" class="col-sm-10 col-sm-offset-2">
                @yield('content')
            </div>
            <footer>
                <div class="contentfooter">
                    @yield('footer')
                </div>
            </footer>
        </div>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>