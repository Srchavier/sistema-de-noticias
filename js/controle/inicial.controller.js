app.controller('inicialController', function ($scope, $http) {

    $scope.noticias = {};
    $scope.getNoticias = function () {
        $http.get('api/getNoticiaFrontend')
            .success(function (data) {
                $scope.noticias = data.noticias;
            })
            .error(function () {
                alert('Falha em obter notícias!!');
            })
    };
    $scope.getNoticias();
});