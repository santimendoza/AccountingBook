<html>
    <head>
        <meta charset="UTF-8">
        <title>Accounting Book</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link type="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>
        <!--<link type="stylesheet" href="resources/css/style.css"/>-->
    </head>
    <body id="loginform">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Accouting Book</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
                    <div id="register-button" class="navbar-right">
                        <ul class="nav navbar-nav">
                            <li><a href="signup">Registrarse</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    @if($errors->registroexitoso->first())
                    <div class='alert alert-info'>
                        {{$errors->registroexitoso->first()}}
                    </div>
                    @endif
                    @if($errors->confirmemail->first())
                    <div class='alert alert-info'>
                        {{$errors->confirmemail->first()}}
                    </div>
                    @endif
                    @if($errors->confirmation->first())
                    <div class='alert alert-info'>
                        {{$errors->confirmation->first()}}
                    </div>
                    @endif
                    <form method="POST" action="http://localhost:8000/sessions" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="coErbE7Mqu40wSduTMYUg3Rr0pn5OjrgFqFTLxbC">
                        <label for="username" class="awesome">Usuario:</label>
                        <input class="form-control" name="username" type="text" id="username">
                        <label for="password" class="awesome">Contraseña:</label>
                        <input class="form-control" name="password" type="password" value="" id="password">
                        <input class="form-control btn btn-success" type="submit" value="Login">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <p><a href="/password-recovery">Olvidé mi contraseña</a>
                        |
                        <a href="/reconfirmation">¿No recibiste el correo de confirmación?</a></p>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </body>
</html>
</html>