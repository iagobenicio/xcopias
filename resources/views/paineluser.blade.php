<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/paineluser.css')}}">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
        <span id="span">X-Cópias</span>
        <a id="logout" href="/logout">sair</a>
    </nav>
    <div class="contents">
        <span style="font-size: 2vw;">Informações</span>
        <div class="dadosinfo">
            <span style="font-size: 1.6vw;">Nome: {{Auth::User()->name}}</span>
            <span style="font-size: 1.6vw;">Uusuario: {{Auth::User()->user}}</span>
            <div>
                <button id="btnedit" onclick="editar()">EDITAR</button>
                <button id="btneditpass" onclick="editarpass()">EDITAR SENHA</button>
            </div>
        </div>
        <span style="font-size: 2vw;">Suas cópias</span>
        <div class="copiasinfo">
            <span style="font-size: 1.6vw;">Cópias mensal: {{Auth::User()->copiasmes}}</span>
            <span style="font-size: 1.6vw;">Cópias restante: {{Auth::User()->copiasrestante}}</span>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form class="contentsedit" action="">
                    <span id="spantop">EDITAR INFORMAÇÕES</span>
                    <div class="labelinpt">
                        <label id="spaninp">nome</label>
                        <input id="inptuser" type="text"  name="nomecadedit"/>
                    </div>
                    <div class="labelinpt">
                        <label id="spaninp">usuário</label>
                        <input id="inptuser" type="text"  name="usernamecadedit"/>
                    </div>
                    <span id="msgedit"></span>
                    <input id="btnformmodal" type="button" onclick="sendedituser()" value="EDITAR"/>
            </form>
        </div>
    </div>

    <div id="myModalpass" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form class="contentsedit" action="">
                    <span id="spantop">EDITAR SENHA</span>
                    <div class="labelinpt">
                        <label id="spaninp">senha atual</label>
                        <input id="inptuser" type="password" placeholder="senha..." name="passcadedit"/>
                    </div>
                    <div class="labelinpt">
                        <label id="spaninp">nova senha</label>
                        <input id="inptuser" type="password" placeholder="senha..." name="newpasscadedit"/>
                    </div>
                    <span id="msgeditpass"></span>
                    <input id="btnformmodal" type="button" onclick="sendedituserpass()" value="EDITAR"/>
            </form>
        </div>
    </div>

    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script>
            function editar(){
                var modal = document.getElementById("myModal");
                modal.style.display = "block";

                var closebtn = document.getElementsByClassName("close")[0];

                closebtn.onclick = function(){
                    document.getElementById("msgedit").innerText = "";
                    modal.style.display = "none";
                }
            }
            function editarpass(){
                var modal = document.getElementById("myModalpass");
                modal.style.display = "block";

                var closebtn = document.getElementsByClassName("close")[1];

                closebtn.onclick = function(){
                    document.getElementById("msgeditpass").innerText = "";
                    modal.style.display = "none";
                }
            }
            window.onclick = function(){
                if(event.target == document.getElementById("myModal")){
                    document.getElementById("msgedit").innerText = "";
                    document.getElementById("myModal").style.display = "none";
                }else{
                    if(event.target == document.getElementById("myModalpass")){
                        document.getElementById("msgeditpass").innerText = "";
                        document.getElementById("myModalpass").style.display = "none";
                    }
                }
            }
            function sendedituser(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                data = {
                    nome: $("input[name=nomecadedit]").val(),
                    username: $("input[name=usernamecadedit]").val()
                },
                $.ajax({
                    type: "POST",
                    url: "{{route('userinfo')}}",
                    data: data,
                    success: function(response) {
                        if(response["msgnotok"]){
                            document.getElementById("msgedit").style.color = "red";
                            document.getElementById("msgedit").innerText = response["msgnotok"];
                        }
                        else{
                            document.getElementById("msgedit").style.color = "green";
                            document.getElementById("msgedit").innerText = "dados alterados"
                        }
                    },
                    error: (e) => {
                        alert('Erro no processo');
                    },
                });
            }
            
            
            function sendedituserpass(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                data = {
                    pass: $("input[name=passcadedit]").val(),
                    newpass: $("input[name=newpasscadedit]").val()
                },
                $.ajax({
                    type: "POST",
                    url: "{{route('userpass')}}",
                    data: data,
                    success: function(response) {
                        if(response["msgnotok"]){
                            document.getElementById("msgeditpass").style.color = "red";
                            document.getElementById("msgeditpass").innerText = response["msgnotok"];
                        }
                        else{
                            document.getElementById("msgeditpass").style.color = "green";
                            document.getElementById("msgeditpass").innerText = "senha alterada";
                        }
                    },
                    error: (e) => {
                        alert('Erro no processo');
                    },
                });
            }
          
    </script>
</body>
</html>