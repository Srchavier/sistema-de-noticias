<html ng-app="app">

<head>
    <title>Lista de Noticias</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.css">

</head>

<body>
    <div ng-controller="verNoticiaController">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        {{noticia.noticiatitulo}}

                        <span class="label label-info pull-right">
                            {{noticia.datanoticia}}
                        </span>
                    </div>
                    <p>{{noticia.noticiatexto}}</p>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js">
    <script src="js/angular/angular.min.js"></script>
    <script src="js/module/app.module.js"></script>

    <!-- Controlles -->

    <script src="js/controle/verNoticia.controller.js"></script>

</body>

</html>