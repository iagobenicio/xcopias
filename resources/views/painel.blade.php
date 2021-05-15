<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/painel.css')}}">
    <title>Painel</title>
</head>
<body>
    <nav class="navbar">
        <span id="span">X-Cópias</span>
        <a id="logout" href="/logout">sair</a>
    </nav>
    <span id="span" style="color: black;">Bem-vindo {{Auth::user()->name}}</span>
    <div class="actionsedit">
        <button id="btnedit" onclick="editar()">EDITAR</button>
        <button id="btneditpass" onclick="editarpass()">EDITAR SENHA</button>
    </div>
    <div class="topactions">
        <button onclick="cadastrar()" id="btn">novo usuário</button>
        <span id="userlist">usuários:</span>
    </div>
    @foreach($usuarios as $user)
    <div class="userinfos">
        <div class="divusertop">
            <span id="textdivusertop">{{$user->name}}</span>
        </div>
        <div class="divuserinfo">
            <span id="textdivuserinfo">cópias mensal: {{$user->copiasmes}}</span>
            <span id="textdivuserinfo">cópias restante: {{$user->copiasrestante}}</span>
        </div>
    </div>
    <div class="actions">
        <button onclick="retirarcopias({{$user->id}})" id="btngerenreti" style="color: white;">retirar</button>
        <button onclick="retornarcopias({{$user->id}})"id="btngerenreto" style="color: white;">retornar</button>
        <button onclick="renovarcopias({{$user->id}})" id="btngerenreno" style="color: white;">renovar</button>
    </div>
    @endforeach
    <div id="myModal" class="modal">

        <div class="modal-content">
          <span class="close">&times;</span>
          <form class="contents" method="POST" action="">
             
                <span id="spantop">cadastro de professores</span>
                
                <div class="labelinpt">
                    <label id="spaninp">nome</label>
                    <input id="inptuser" type="text" placeholder="professor..." name="nomecad"/>
                </div>
                <div class="labelinpt">
                    <label id="spaninp">usuário</label>
                    <input id="inptuser" type="text" placeholder="usuario..." name="usernamecad"/>
                </div>
                <div class="labelinpt">
                    <label id="spaninp">senha</label>
                    <input id="inptuser" type="password" placeholder="senha..." name="passcad"/>
                </div>
                <span id="msgcdprof"></span>
                <input id="btnformmodal" type="button" onclick="sendcduser()" value="CADASTRAR"/>
          </form>
        </div>
    </div>

    <div id="myModalretirar" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <form class="contents">
                <input type="hidden" id="rtid" name="idrt" value="">
                <span id="spantop">retirar</span>
                <span style="font-size: 1.5vw;">Escolha uma quantidade de cópias para serem retiradas deste determinado professor. </span>
                <div class="labelinpt">
                    <label id="spaninp">quantidade</label>
                    <input id="inptuser" type="number" name="quantrt" placeholder="EX:5" />
                </div>
                <span id="msgreti"></span>
                <input id="btnformmodal" type="button" onclick="sendretirar()" value="RETIRAR">
          </form>
        </div>
    </div>
    <div id="myModalretornar" class="modal">

        <div class="modal-content">
          <span class="close">&times;</span>
          <form class="contents">
            <input type="hidden" id="rtoid" name="idrto" value="">
                <span id="spantop">retornar</span>
                <span style="font-size: 1.5vw;">Escolha uma quantidade para ser reotornada à quantidade restante deste determinado professor</span>
                <div class="labelinpt">
                    <label id="spaninp">quantidade</label>
                    <input id="inptuser" type="number" name="quantrto" placeholder="EX:5" />
                </div>
                <span id="msgreto"></span>
                <input id="btnformmodal" type="button" onclick="sendretornar()" value="RETORNAR">
          </form>
        </div>
    </div>
    <div id="myModalrenovar" class="modal">

        <div class="modal-content">
          <span class="close">&times;</span>
          <form class="contents">
                <input type="hidden" id="rnid" name="idrn" value="">
                <span id="spantop">renovar</span>
                <span style="font-size: 1.5vw;">Escolha uma nova quantidade de cópias mensal para este determinado professor</span>
                <div class="labelinpt">
                    <label id="spaninp">quantidade</label>
                    <input id="inptuser" type="number" name="quantrn" placeholder="EX:5" />
                </div>
                <span id="msgreno"></span>
                <input id="btnformmodal" type="button" onclick="sendrenovar()" value="RENOVAR">
          </form>
        </div>
    </div>



    <div id="myModaledit" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form class="contents" action="">
                    <span id="spantop">EDITAR INFORMAÇÕES DO ADMINISTRADOR</span>
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
            <form class="contents" action="">
                    <span id="spantop">EDITAR SENHA DO ADMINISTRADOR</span>
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
        
        function cadastrar(){
            var modal = document.getElementById("myModal");
            modal.style.display = "block";

            var closebtn = document.getElementsByClassName("close")[0];

            closebtn.onclick = function(){
                document.getElementById("msgcdprof").innerText = "";
                modal.style.display = "none";
            }
        }

        function retirarcopias(id){
            
            document.getElementById('rtid').value = id;
            var modalret = document.getElementById("myModalretirar");
            modalret.style.display = "block";

            var closebtn = document.getElementsByClassName("close")[1];

            closebtn.onclick = function(){
                document.getElementById("msgreti").innerText = "";
                modalret.style.display = "none";
            }

        }

        function retornarcopias(id){
            
            document.getElementById('rtoid').value = id;
            var modalreto = document.getElementById("myModalretornar");
            modalreto.style.display = "block";

            var closebtn = document.getElementsByClassName("close")[2];

            closebtn.onclick = function(){
                document.getElementById("msgreto").innerText = "";
                modalreto.style.display = "none";
            }

        }
        function renovarcopias(id){
            
            document.getElementById('rnid').value = id;
            var modalreno = document.getElementById("myModalrenovar");
            modalreno.style.display = "block";

            var closebtn = document.getElementsByClassName("close")[3];

            closebtn.onclick = function(){
                document.getElementById("msgreno").innerText = "";
                modalreno.style.display = "none";
            }

        }

        function editar(){
            var modal = document.getElementById("myModaledit");
            modal.style.display = "block";

            var closebtn = document.getElementsByClassName("close")[4];

            closebtn.onclick = function(){
                document.getElementById("msgedit").innerText = "";
                modal.style.display = "none";
            }
        }
        function editarpass(){
            var modal = document.getElementById("myModalpass");
            modal.style.display = "block";

            var closebtn = document.getElementsByClassName("close")[5];

            closebtn.onclick = function(){
                document.getElementById("msgeditpass").innerText = "";
                modal.style.display = "none";
            }
        }

        window.onclick = function(){
            if (event.target == document.getElementById("myModalretirar")) {
                document.getElementById("msgreti").innerText = "";
                document.getElementById("myModalretirar").style.display = "none";
            }else{
                if(event.target == document.getElementById("myModalretornar")){
                    document.getElementById("msgreto").innerText = "";
                    document.getElementById('myModalretornar').style.display = "none";
                }else{
                    if(event.target == document.getElementById("myModalrenovar")){
                        document.getElementById("msgreno").innerText = "";
                        document.getElementById("myModalrenovar").style.display = "none";
                    }else{
                        if(event.target == document.getElementById("myModaledit")){
                            document.getElementById("msgedit").innerText = "";
                            document.getElementById("myModaledit").style.display = "none";
                        }else{
                            if(event.target == document.getElementById("myModalpass")){
                                document.getElementById("msgeditpass").innerText = "";
                                document.getElementById("myModalpass").style.display = "none";
                            }else{
                                if(event.target == document.getElementById("myModal")){
                                    document.getElementById("msgcdprof").innerText = "";
                                    document.getElementById("myModal").style.display = "none";
                                }
                            }
                        }
                    }
                }
            }
        }
        

            function sendcduser(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                data = {
                    nome: $("input[name=nomecad]").val(),
                    username: $("input[name=usernamecad]").val(),
                    pass: $("input[name=passcad]").val()
                },
                $.ajax({
                    type: "POST",
                    url: "{{route('cduser')}}",
                    data: data,
                    success: function(response) {
                        if(response["msgnotok"]){
                            document.getElementById("msgcdprof").style.color = "red";
                            document.getElementById("msgcdprof").innerText = response["msgnotok"];
                        }
                        else{
                            document.getElementById("msgcdprof").style.color = "green";
                            document.getElementById("msgcdprof").innerText = "professor cadastrado";
                        }
                    },
                    error: (e) => {
                        alert('Erro no processo');
                    },
                });
            }



            function sendretirar(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                data = {
                    id: $("input[name=idrt]").val(),
                    quantidade: $("input[name=quantrt]").val()
                },
                $.ajax({
                    type: "POST",
                    url: "{{route('rtcopias')}}",
                    data: data,
                    success: function(response) {
                        if(response['msgnotok']){
                            document.getElementById("msgreti").style.color = "red";
                            document.getElementById("msgreti").innerText = response["msgnotok"];
                        }else{
                            window.location.href = "{{route('padm')}}"
                        }
                    },
                    error: (e) => {
                        alert('Erro no processo');
                    },
                });
            }

            function sendretornar(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                data = {
                    id: $("input[name=idrto]").val(),
                    quantidade: $("input[name=quantrto]").val()
                },
                $.ajax({
                    type: "POST",
                    url: "{{route('rtocopias')}}",
                    data: data,
                    success: function(response) {
                        if(response['msgnotok']){
                            document.getElementById("msgreto").style.color = "red";
                            document.getElementById("msgreto").innerText = response["msgnotok"];
                        }else{
                            window.location.href = "{{route('padm')}}"
                        }
                    },
                    error: (e) => {
                        alert('Erro no processo');
                    },
                });
            }

            function sendrenovar(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                data = {
                    id: $("input[name=idrn]").val(),
                    quantidade: $("input[name=quantrn]").val()
                },
                $.ajax({
                    type: "POST",
                    url: "{{route('rncopias')}}",
                    data: data,
                    success: function(response) {
                        if(response['msgnotok']){
                            document.getElementById("msgreno").style.color = "red";
                            document.getElementById("msgreno").innerText = response["msgnotok"];
                        }else{
                            window.location.href = "{{route('padm')}}"
                        }
                    },
                    error: (e) => {
                        alert('Erro no processo');
                    },
                });
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
                            document.getElementById("msgedit").innerText = "dados alterados";
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