<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход</title>
    @vite(['resources/css/app.css'])
</head>
<body>
<main>
    <p>Здравствуйте, {{ $first_name }} {{ $last_name }}!</p>
    {{$accounts}}

</main>
</body>
</html>
