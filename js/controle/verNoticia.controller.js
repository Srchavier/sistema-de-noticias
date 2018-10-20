var app = angular.module('app', ['ngSanitize']);

app.controller('verNoticiaController', function ($scope, $http, $location) {

    $scope.noticia = {};
    $scope.noticia.idnoticia = $location.search().id;
    $scope.fotoMaior = '';

    $scope.getNoticia = function () {
        $http.get('api/getNoticiaFrontend/' + $scope.noticia.idnoticia)
            .success(function (data) {
                $scope.noticia = data.noticias[0].noticia;
            })
            .error(function () {
                alert('Falha em obter notícias!!');
            })
    };
    $scope.getNoticia();

    $scope.abreFoto = function (foto) {
        $scope.fotoMaior = foto;
        $('#verfoto').modal('show')  
    };
});


app.config(function ($locationProvider) {
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
});