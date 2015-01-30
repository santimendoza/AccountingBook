<html>
    <head>
        <meta charset="UTF-8">
        <title>Accounting Book</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        {{ HTML::style('resources/bootstrap/css/bootstrap.min.css' , array('media'=>'screen')) }}
        <link rel="stylesheet" href="/resources/css/style.css"/>
    </head>
    <body>
        <div id="container" class="container-fluid">
            @section('header')
            <div data-spy="affix" id="sidebar-container" class="col-sm-2">
                <div id="sidebar" class="col-sm-12">
                    <h2>Accounting Book</h2>
                    <div id="profileinfo" class="media">
                        <div class="media-left">
                            <a href="/user">
                                <img class="media-object" src="/resources/imgs/defaultprofile.png" alt="..." width="30px" height="30px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{Auth::user()->name}} {{Auth::user()->lastname}}</h4>
                        </div>
                    </div>
                    <nav>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="/user">Dashboard</a></li>
                            <li><a href="#">Ingresos</a></li>
                            <li><a href="#">Egresos</a></li>
                            <li><a href="#">Categorías</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
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
        {{ HTML::script('resources/js/jquery.min.js') }}
        {{ HTML::script('resources/bootstrap/js/bootstrap.min.js') }}
    </body>
</html>