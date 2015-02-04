<html>
    <head>
        <meta charset="UTF-8">
        <title>Accounting Book</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        {{ Html::style('resources/bootstrap/css/bootstrap.min.css' , array('media'=>'screen')) }}
        {{ Html::style('resources/css/style.css' , array('media'=>'screen')) }}
    </head>
    <body id="loginform">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Accouting Book</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <h1>Registrarse</h1>
                    {{ Form::open(array('action' => 'UserController@store', 'method' => 'post')) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Nombre:', array('class' => 'awesome')) }}
                        {{ Form::text('name' , null, array('class' => 'form-control', 'required')) }}
                    </div>
                    @if($errors->signup->first('name') != null)
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->signup->first('name')}}
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('lastname', 'Apellido:', array('class' => 'awesome')) }}
                        {{ Form::text('lastname' , null, array('class' => 'form-control', 'required')) }}
                    </div>
                    @if($errors->signup->first('lastname') != null)
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->signup->first('lastname')}}
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('email', 'Email:', array('class' => 'awesome')) }}
                        {{ Form::email('email', null, array('class' => 'form-control', 'required')) }}
                    </div>
                    @if($errors->signup->first('email') != null)
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->signup->first('email')}}
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('username', 'Usuario:', array('class' => 'awesome')) }}
                        {{ Form::text('username' , null, array('class' => 'form-control', 'required')) }}
                    </div>
                    @if($errors->signup->first('username') != null)
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->signup->first('username')}}
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('password', 'Contraseña:', array('class' => 'awesome')) }}
                        {{ Form::password('password', array('class' => 'form-control', 'required')) }}
                    </div>
                    @if($errors->signup->first('password') != null)
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->signup->first('password')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="currency">Moneda:</label>
                        <select class="form-control" name="currency">
                            <option value="1">COP</option>
                            <option value="2">USD</option>
                            <option value="3">EUR</option>
                        </select>
                    </div>
                    @if($errors->signup->first('currency') != null)
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->signup->first('currency')}}
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::submit('Registrarse', array('class' => 'form-control btn btn-success', 'required')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        {{ HTML::script('resources/js/jquery.min.js') }}
        {{ HTML::script('resources/bootstrap/js/bootstrap.min.js') }}
    </body>
</html>
</html>