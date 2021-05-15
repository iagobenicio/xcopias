<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>Login</title>
</head>
<body>
    <form class="contents" method="POST" action="/checklogin">
        @csrf
        <span id="title" >X-Cópias</span>
    
            <div class="inputuser">
                <label id="spaninp">usuário</label>
                <input id="inptusername" type="text" placeholder="digite seu nome de usuário" name="nome"/> 
            </div>
            <div class="inputpassword">
                <label id="spaninp">senha</label>
                <input id="inptuserpass" type="password" placeholder="digite sua senha" name="pass"/>
            </div> 
            @if($errors->any())
                <span style="color: red;">{{$errors->first()}}</span>
            @endif
        <input id="btn" type="submit" value="ENTRAR">
    </form>
</body>
</html>