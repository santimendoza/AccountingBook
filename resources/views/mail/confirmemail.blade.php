<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="page-header">
                <h1>¡Bienvenido, {{$user['name']}}!</h1>
            </div>
            <p>Has recibido este correo porque te has registrado en nuestra página.
                Para confirmar tu cuenta, solo tienes que hacer clic en el siguiente enlace:
            </p>
            <a href="{{'http://localhost:8000/code/'.$user['confirmation_code']}}">Confirmar cuenta</a>
            <p>Este enlace de confirmación solo es valido por 2 días.</p>
            <p>Si no te has registrado en nuestra página, ignora este email.</p>
        </div>
    </div>
</div>