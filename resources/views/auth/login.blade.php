<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <input type="email" name="email" id="" placeholder="email"><br>
        <input type="password" name="password" id="" placeholder="password"><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>