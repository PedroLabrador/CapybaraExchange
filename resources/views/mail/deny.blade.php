<!DOCTYPE html>

<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

	<title>Venta rechazada</title>

</head>

<body>

	<h1><p style="text-align: center; margin-top: 5%"><a href="htts://capybaraexchange.com"><style>img {max-width: 230px; width: 35%;height: auto;}</style><img src="https://www.capybaraexchange.com/img/Icono.png" width="230px" maxheight="230px"></p></a></h1>

	<h1><p style="text-align: center; margin-top: 5%">Estimado/a {{ $user->name }}</p></h1>

    <p><p style="text-align: center; margin-top: 5%">Se le informa que su venta por {{ $payment->amount }} {{ $payment->currency }} ha sido rechazada, debe comunicarse con soporte para recibir asistencia.</p></p>

	<p><p style="text-align: center; margin-top: 5%">El motivo para declinar su transacción es que {{ $payment->reference }}.</p></p>

	<p><p style="text-align: center; margin-top: 5%">Por favor contacta con soporte tan pronto como te sea posible por <a href="www.t.me/capybaraexchange">Telegram</a>, <a href="https://discord.gg/zFPWeVK">Discord</a> o env&iacute;anos un correo a <a href="mailto:support@capybaraexchange.com">support@capybaraexchange.com</a>.</p></p>

	<p><p style="text-align: center; margin-top: 5%">Gracias por elegir al Capybara.</p></p>

	<p><p style="text-align: center; margin-top: 5%">Equipo de <a href="www.capybaraexchange.com">capybaraexchange.com</a></p></p>

</body>

</html>