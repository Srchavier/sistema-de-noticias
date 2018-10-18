var app = angular.module('app', ['ui.mask']);

app.controller('painelInicialControle', function ($scope, $http) {

    $scope.showCadastro = false;
    $scope.noticia = objNoticia();

    $scope.abreCadastroNoticia = function () {
        $scope.showCadastro = true;
    }

    $scope.cadastrarNovaNoticia = function () {
        $http.post('../api/cadastrarNovaNoticia', $scope.noticia)
            .success(function (data) {
                if(!data.erro) {
                    alert('Cadastro efetuado com sucesso!');
                    $scope.showCadastro = false;
                    $scope.noticia = objNoticia();
                }
            })
            .error(function () {
                alert('Error ao cadastrar')
            });
    }
});

function objNoticia() {
    return {
        idnoticia: -1,
        noticiatitulo: '',
        noticiadescricao: '',
        noticiatexto: '',
        noticiadata: ''
    };
}