<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>Login</title>
</head>
<body>
    <form class="contents" method="POST" action="/checklogin">
        @csrf
        <h1 class="display-6">X-Cópias</h1>
        <div class="mb-3">
            <label for="exampleInputUsername" class="form-label">usuário</label>
            <input type="text" class="form-control" name="nome" id="exampleInputUsername">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">senha</label>
            <input type="password" class="form-control" name="pass" id="exampleInputPassword">
        </div>
        <div>
            @if($errors->any())
                <span style="color: red;">{{$errors->first()}}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-secondary" style="background-color: #3a6475">entrar</button>
    </form>
</body>
</html>