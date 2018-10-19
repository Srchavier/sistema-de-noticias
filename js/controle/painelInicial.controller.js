var app = angular.module('app', ['ui.mask', 'angular-loading-bar']);

app.controller('painelInicialControle', function ($scope, $http) {

    $scope.showCadastro = false;
    $scope.noticia = objNoticia();
    $scope.allNoticias = {};
    $scope.abreCadastroNoticia = function () {
        $scope.noticia = objNoticia();
        $scope.showCadastro = true;
    };

    $scope.listarNoticias = function () {
        $http.get('../api/listarNoticias')
            .success(function (data) {
                $scope.allNoticias = data.noticias;
            })
            .error(function () {
                $.gritter.add({
                    title: "Error",
                    text: "Ocorreu ao listar!",
                    class_name: "gritter"
                });
            });
    };

    $scope.getNoticia = function (idNoticia) {
        $http.get('../api/getnoticia/' + idNoticia)
            .success(function (data) {
                $scope.noticia = data.noticia;
                $scope.showCadastro = true;
            })
            .error(function () {
                $.gritter.add({
                    title: "Error",
                    text: "Ocorreu ao fazer getNoticia!",
                    class_name: "gritter"
                });
            });
    }

    $scope.processaFormNoticia = function () {
        if ($scope.noticia.idnoticia === -1) {
            $scope.cadastrarNovaNoticia();
        } else {
            $scope.alterarNoticia();
        }
    };

    $scope.cadastrarNovaNoticia = function () {
        $http.post('../api/cadastrarNovaNoticia', $scope.noticia)
            .success(function (data) {
                if (!data.erro) {
                    $.gritter.add({
                        title: "Sucesso",
                        text: "Notícia cadastrada com sucesso!",
                        class_name: "gritter"
                    });
                    $scope.showCadastro = false;
                    $scope.noticia = objNoticia();
                    $scope.listarNoticias();
                };
            })
            .error(function () {
                $.gritter.add({
                    title: "Error",
                    text: "Ocorreu um error!",
                    class_name: "gritter"
                });
            });
    };

    $scope.alterarNoticia = function () {
        $http.post('../api/alterarNoticia/' + $scope.noticia.idnoticia, $scope.noticia)
            .success(function (data) {
                if (!data.erro) {
                    $.gritter.add({
                        title: "Sucesso",
                        text: "Notícia alterada com sucesso!",
                        class_name: "gritter"
                    });
                    $scope.showCadastro = false;
                    $scope.noticia = objNoticia();
                    $scope.listarNoticias();
                };
            })
            .error(function () {
                $.gritter.add({
                    title: "Error",
                    text: "Ocorreu um error!",
                    class_name: "gritter"
                });
            });
    };
    $scope.listarNoticias();
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