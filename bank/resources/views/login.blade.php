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
        <div class="form__wrapper">
            <form action="{{url('user')}}" method="post">
                <h3>Вход</h3>
                <label>Email <input type="email" name="email"></label>
                <br>
                <label>Пароль <input type="password" name="password"></label>
                <br>
                <input type="submit">
            </form>
        </div>
    </main>
</body>
</html>
