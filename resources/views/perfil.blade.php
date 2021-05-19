<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/perfil.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perfil</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar navbar-light" style="background-color: #3a6475;">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" style="color: white;">X-Cópias</a>
          
          <button style="background-color: white;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse"  id="navbarSupportedContent">
            <div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white;">inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: white;">perfil</a>
                </li>
            </ul>
            </div>
            <div class="buttonexit">
            <a href="/logout"><button  class="btn btn-outline-light" type="submit">sair</button></a>
            </div>
          </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 10%;">
        <div class="row">
            <span style="font-family: sans-serif; font-size: 24px;">Meus dados</span>
        </div>
        <div class="row" style="padding-left: 10px;">
            <span style="font-family: sans-serif; font-size: 18px;">nome: <span style="color: #0b6a8d;">administrador</span></span>
            <span style="font-family: sans-serif; font-size: 18px;">usuário: <span style="color: #0b6a8d;">adminteste</span></span>
        </div>
        <div class="row">
            <span style="font-family: sans-serif; font-size: 24px;">Formulários de edição</span>
        </div>
        <div class="row" style="padding-left: 10px;">
            <span style="font-family: sans-serif; font-size: 18px;">Nome/usuário</span>
            <div class="row" style="padding-left: 10%;">
                <form>
                    <div class="form-group">
                      <label for="exampleInputName">nome</label>
                      <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="novo nome...">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername">nome de usuário</label>
                      <input type="text" class="form-control" id="exampleInputUsername" placeholder="novo nome de usuário...">
                    </div>
                    <button  id="idsubmit" class="btn btn-primary">alterar</button>
                  </form>
            </div>
            <hr style="margin-top: 10px;">
            <span style="font-family: sans-serif; font-size: 18px;">Senha</span>
            <div class="row" style="padding-left: 10%;">
                <form>
                    <div class="form-group">
                      <label for="exampleInputName">senha atual</label>
                      <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="senha atual...">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername">nova senha</label>
                      <input type="text" class="form-control" id="exampleInputUsername" placeholder="novo senha...">
                    </div>
                    <button  id="idsubmit" class="btn btn-primary">alterar</button>
                    <div>
                      <span style="color: red; display: none;"></span>
                      <span style="color: green; display: none;"></span>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</body>
</html>