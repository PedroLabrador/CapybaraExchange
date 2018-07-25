<!DOCTYPE html>

<html>

<head>

	<title>Venta denegada</title>

</head>

<body>

	<h1>Venta denegada!!</h1>

	<span>Estimado usuario: {{ $user->name }}</span>

	<p>Tu venta por {{ $payment->amount }} {{ $payment->currency }} no ha sido aprobada!</p>

	<p>Reason: {{ $payment->reference }}</p>

	<p>Por favor contacta a soporte tan pronto como te sea posible</p>

	<p>Telegram, o <a href="#">support@capybaraexchange.com</a></p>

	<p>Trabajamos para ofrecerte lo mejor.</p>

	<p>Equipo de <a href="www.capybaraexchange.com">capybaraexchange.com</a></p>

</body>

</html>