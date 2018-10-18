<html ng-app="app">

<head>
    <title>Painel Administrativo - Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css">

</head>

<body>
    <div ng-controller="loginController">

        <div class="container" ng-init="visivel=false">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h3>Efetue Login</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-7">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Entre com email" ng-model="login.usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="senha" ng-model="login.senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary" ng-click="fazerLogin();">Efetuar Login</button>
                        <small ng-show="visivel" id="emailHelp" class="form-text text-muted">E-mail ou senha incorretos</small>

                    </form>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <h4>Instrucões de login</h4>
                    <p>Cuide letras maiusculas e minusculas</p>
                </div>

            </div>
        </div>

    </div>

    <script src="../js/angular/angular.min.js"></script>
    <script src="../js/module/app.module.js"></script>

    <!-- Controlles -->

    <script src="../js/controle/login.controller.js"></script>

</body>

</html>