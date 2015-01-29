<html>
    <head>
        <meta charset="UTF-8">
        <title>Accounting Book</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        {{ HTML::style('resources/bootstrap/css/bootstrap.min.css' , array('media'=>'screen')) }}
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Accouting Book</a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    {{ Form::open(array('action' => 'SessionsController@store', 'method' => 'post')) }}
                    <div class="form-group">
                        {{ Form::label('username', 'Usuario:', array('class' => 'awesome')) }}
                        {{ Form::text('username' , null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Contraseña:', array('class' => 'awesome')) }}
                        {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>
                    @if(isset($message))
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::submit('Login', array('class' => 'form-control')) }}
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