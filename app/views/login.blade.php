<html>
    <head>
        <meta charset="UTF-8">
        <title>Accounting Book</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        {{ HTML::style('resources/bootstrap/css/bootstrap.min.css' , array('media'=>'screen')) }}
        {{ HTML::style('resources/css/style.css' , array('media'=>'screen')) }}
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

                    {{ Form::open(array('action' => 'SessionsController@store', 'method' => 'post')) }}
                    <div class="form-group">
                        {{ Form::label('username', 'Usuario:', array('class' => 'awesome')) }}
                        {{ Form::text('username' , null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Contraseña:', array('class' => 'awesome')) }}
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>
                    @if($errors->login->first() != null)
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->login->first() }}
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::submit('Login', array('class' => 'form-control btn btn-success')) }}
                    </div>
                    {{ Form::close() }}
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
        {{ HTML::script('resources/js/jquery.min.js') }}
        {{ HTML::script('resources/bootstrap/js/bootstrap.min.js') }}
    </body>
</html>
</html>