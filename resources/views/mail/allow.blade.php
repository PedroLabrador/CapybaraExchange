<!DOCTYPE html>

<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

	<title>Venta aprobada</title>

</head>

<body>

	<h1><p style="text-align: center; margin-top: 5%"><a href="htts://capybaraexchange.com"><style>img {max-width: 230px; width: 35%;height: auto;}</style><img src="https://www.capybaraexchange.com/img/Icono.png" width="230px" maxheight="230px"></p></a></h1>
	
	<h1><p style="text-align: center; margin-top: 5%">Estimado/a {{ $user->name }}</p></h1>

	<p><p style="text-align: center; margin-top: 5%">Se le informa que su venta por {{ $payment->amount }} {{ $payment->currency }} ha sido aprobada y finaliz&oacute; exitosamente.</p></p>

	<p><p style="text-align: center; margin-top: 5%">Fueron transferidos a su cuenta del banco {{ $payment->bankaccount->bank->bankname }} la cantidad de {{ $payment->to_pay }}Bs</p></p>

	<p><p style="text-align: center; margin-top: 5%">El numero de referencia por la transacci&oacute;n es: {{ $payment->reference }}</p></p>

	<p><p style="text-align: center; margin-top: 5%">Gracias por elegir al Capybara.</p></p>

	<p><p style="text-align: center; margin-top: 5%">Equipo de <a href="www.capybaraexchange.com">capybaraexchange.com</a></p></p>

</body>

</html>