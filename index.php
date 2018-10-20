<html ng-app="app">

<head>
    <title>Lista de Noticias</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css">

</head>

<body>
    <div ng-controller="inicialController">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h3>Nossas notícias - V1</h3>
                    </div>
                    <div class="jumbotron">
                        <h1>Seja Bem Vindo!</h1>
                        <p>Sistema de notícia - V1</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-info" ng-repeat="item in noticias">

                            <div class="alert alert-warning" ng-show="noticias.length===0">
                                    <strong>Nenhuma noticia cadastrada</strong>
                                </div>
                        <h3>
                            <span class="label label-primary" style="margin-right: 10px">
                                {{item.noticia.dados.datanoticia}}
                            </span> -
                            <a href="verNoticia.php?id={{item.noticia.dados.idnoticia}}">{{item.noticia.dados.noticiatitulo}}</a>
                        </h3>
                        <p>{{item.noticia.dados.noticiatexto}}</p>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="js/angular/angular.min.js"></script>
    <script src="js/module/app.module.js"></script>

    <!-- Controlles -->

    <script src="js/controle/inicial.controller.js"></script>

</body>

</html>