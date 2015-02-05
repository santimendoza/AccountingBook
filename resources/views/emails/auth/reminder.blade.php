<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			Para resetear tu contraseña, complete el siguiente formulario: {{ URL::to('password/reset', array($token)) }}.<br/>
			Este link expirara en {{ Config::get('auth.reminder.expire', 60) }} minutos.
		</div>
	</body>
</html>
