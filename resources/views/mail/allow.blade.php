<!DOCTYPE html>

<html>

<head>

	<title>Venta aprobada</title>

</head>

<body>

	<h1>Venta aprobada!!</h1>

	<span>Usuario: {{ $user->name }}</span>

	<p>Tu venta por {{ $payment->amount }} {{ $payment->currency }} ha sido aprobada!</p>

	<p>ha sido acreditado en tu cuenta {{ $payment->bankaccount->bank->name }} la cantidad de {{ $payment->to_pay }}Bs</p>

	<p>Su numero de referencia por la transacción es: {{ $payment->reference }}</p>

	<p>Gracias por elegirnos.</p>

	<p>Equipo de <a href="www.capybaraexchange.com">capybaraexchange.com</a></p>

</body>

</html>