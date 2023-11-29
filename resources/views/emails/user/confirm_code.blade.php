<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
Добрый день!<br>
<br>
Чтобы войти в Eskhata Online, введите одноразовый код:<br>
<br>
<b>54742</b><br>
<br>
Если вы не запрашивали код доступа, просто удалите это письмо.<br>
<br>
Thanks,<br>
{{ config('app.name') }}
</body>
</html>

{{--
@component('mail::message')
    Добрый день!

    Чтобы войти в Eskhata Online, введите одноразовый код:

    ## 54742

    Если вы не запрашивали код доступа, просто удалите это письмо.

    Thanks,
{{ config('app.name') }}
@endcomponent
--}}

