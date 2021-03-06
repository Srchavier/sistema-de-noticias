<?php
    session_start();
    if(!isset($_SESSION['logado'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html ng-app="app">

<head>
    <title>Painel Administrativo - Login</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <link rel="stylesheet" href="../js/angular/loading-bar.min.css">
    <link rel="stylesheet" href="../js/jquery/jquery.gritter.css">

    <link rel="stylesheet" href="../css/estilo.css">

</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Painel de Notícias
                </a>
            </div>
        </div>
    </nav>

    <div ng-controller="painelInicialControle">


        <div class="container" ng-show="chatUsuarios.length>0">                 
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Atendimentos</h2>
                        
                        <div class="col-xs-12">
                            <div 
                                 class="alert alert-info"
                                 style="height:350px; overflow:scroll; overflow-x:hidden;" 
                                 id="mostra_mensagens"
                            >
                            
                                <div 
                                     class="well well-sm"
                                     ng-repeat="msg in chatUsuarios[usuarioAtivo].mensagens"
                                     >
                                
                                    <p>De: {{msg.de}}</p>
                                    <p>{{msg.msg}}</p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <hr/>
                        
                        <div class="col-xs-12">
                            <a 
                               href="#"
                               ng-repeat="(ind, u) in chatUsuarios"
                               ng-click="setUsuarioAtivo(ind)"
                               class="btn btn-primary"
                               >
                                {{u.usuario}}
                            </a>
                        </div>
                        
                        <div class="col-xs-10">
                        
                            <input 
                                   type="text"
                                   class="form-control"
                                   placeholder="Mensagem"
                                   ng-model="novaMensagem"
                                   ng-keyup="$event.keyCode == 13 ? enviarMensagem() : null"
                                   >
                            
                        </div>
                        <div class="col-xs-2">
                            <button
                                class="btn btn-primary btn-block"
                                type="button"
                                ng-click="enviarMensagem()"
                                ng-disabled="novaMensagem!=''"
                                
                                    >
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr>



        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="well well-sm">
                        <button type="button" class="btn btn-primary" ng-click="abreCadastroNoticia()">
                            Cadastrar Notícia
                        </button>
                        <button type="button" class="btn btn-success" ng-click="chatStatus()" ng-hide="chat!=true">
                            Chat Online
                        </button>
                        <button type="button" class="btn btn-danger" ng-click="chatStatus()" ng-show="chat==false">
                            Chat Offline
                        </button>
                        <a href="../api/logout" class="btn btn-danger pull-right" onclick="return confirm('Tem certeza')">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- form cadastro notícias -->
        <div class="container" ng-show="showCadastro">
            <form ng-submit="processaFormNoticia()">

                <div class="row mbottom">
                    <div class="col-xs-3 text-right">
                        Título:
                    </div>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" ng-model="noticia.noticiatitulo" required>
                    </div>
                </div>

                <div class="row mbottom">
                    <div class="col-xs-3 text-right">
                        Descrição:
                    </div>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" ng-model="noticia.noticiadescricao">
                    </div>
                </div>

                <div class="row mbottom">
                    <div class="col-xs-3 text-right">
                        Data:
                    </div>
                    <div class="col-xs-9">
                        <input class="form-control" ng-model="noticia.noticiadata" ui-mask="99/99/9999"
                            model-view-value="true">
                    </div>
                </div>

                <div class="row mbottom">
                    <div class="col-xs-3 text-right">
                        Texto:
                    </div>
                    <div class="col-xs-9">
                        <textarea class="form-control" ng-model="noticia.noticiatexto" rows="5">
                            </textarea>
                    </div>
                </div>

                <div class="row mbottom">
                    <div class="col-xs-9 col-xs-offset-3">
                        <button class="btn btn-danger" type="submit" ng-show="noticia.idnoticia==-1">
                            Cadastrar
                        </button>
                        <button class="btn btn-success" type="submit" ng-show="noticia.idnoticia!=-1">
                            Alterar
                        </button>
                    </div>
                </div>

            </form>
        </div>
        <!-- /form cadastro notícias -->

        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="120">Data</th>
                                <th width="120">Título</th>
                                <th width="60">Status</th>
                                <th width="120">-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="noticia in allNoticias">
                                <td>{{noticia.datanoticia}}</td>
                                <td>{{noticia.noticiatitulo}}</td>
                                <td>
                                    <button type="button" class="btn btn-default" title="nesste momento a noticia está bloqueada"
                                        ng-show="noticia.noticiastatus==1" ng-click="trocaStatus(noticia, 2)">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </button>
                                    <button type="button" class="btn btn-default" title="nesste momento a noticia está visivel"
                                        ng-show="noticia.noticiastatus!=1" ng-click="trocaStatus(noticia, 1)">
                                        <i class="glyphicon glyphicon-eye-close"></i>
                                    </button>
                                </td>
                                <td>
                                    <a href="gerenciarImagens.php?idnoticia={{noticia.idnoticia}}" class="btn btn-default">
                                        <i class="glyphicon glyphicon-picture"></i>
                                    </a>
                                    <button type="button" class="btn btn-default" ng-click="getNoticia(noticia.idnoticia)">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" ng-click="excluirNoticia(noticia.idnoticia)">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="alert alert-warning" ng-show="allNoticias.length==0">
                        <strong>Nenhuma noticia cadastrada</strong>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <script src="../js/jquery/jquery.gritter.min.js"></script>

    <script src="../js/angular/angular.min.js"></script>
    <script src="../js/angular/ui-utils.min.js"></script>
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script src="../js/angular/ng-socket-io.js"></script>

    <script src="../js/angular/loading-bar.min.js"></script>

    <script src="../js/controle/painelInicial.controller.js"></script>
</body>

</html>