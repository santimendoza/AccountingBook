@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="/auth/register" validate="validate">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nombre(s)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" required name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Apellido(s)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" required name="lastname" value="{{ old('lastname') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" required name="email" value="{{ old('email') }}" placeholder="@">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Usuario</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" required name="username" required pattern="([A-Za-z]*([0-9]*|[A-Za-z]*)*|[0-9]*([0-9]*|[A-Za-z]*)*)" value="{{ old('username') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Moneda</label>
                            <div class="col-md-6">
                                <select required class="form-control" name="currency">
                                    <option disabled selected>Currency</option>
                                    <option value="1">COP</option>
                                    <option value="2">USD</option>
                                    <option value="3">EUR</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Saldo</label>
                            <div class="col-md-6">
                                <input type="text" required name="balance" id="balance" pattern="[0-9]+(.[0-9]+|)" value="{{ old('balance')}}" class="form-control"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Día de corte (dd)</label>
                            <div class="col-md-6">
                                <input type="text" name="courdate" required id="courdate" pattern="([0-2][0-9]|[3][0-1])" value="{{ old('courdate')}}" placeholder="01" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" required class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" required class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
