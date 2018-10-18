app.controller('loginController', function ($scope, $http) {

    $scope.login = {
        usuario: '',
        senha: ''
    };

    $scope.fazerLogin = function () {

        if ($scope.login.usuario.trim() === '' && $scope.login.senha.trim()==='') {
            $scope.visivel = true;
            return;
        } else {
            $http.post('../api/login', $scope.login)
                .success(function (data) {
                    console.log(data);

                    if (data.logado) {
                        window.location = "painel-inicial.php"
                    } else {
                        alert('Verifique usúario ou senha');
                    }
                })
        }
    }

});