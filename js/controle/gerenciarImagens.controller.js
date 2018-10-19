var app = angular.module('app', ['angular-loading-bar','angularFileUpload']);

app.controller('gerenciarImagensControle', function ($scope, $http, $location, FileUploader) {

    $scope.noticia = {};

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
    };

    $scope.getNoticia($location.search().idnoticia);


    var uploader = $scope.uploader = new FileUploader({
        url : '../api/cadastrarImagem/'+ $location.search().idnoticia
    });
    
    uploader.filters.push({
        name : "tamanhoFila",
        fn : function(item, options){
            return this.queue.length < 4;
        }
    });
    
    uploader.onSuccessItem = function(fileItem){
        $.gritter.add({
            title: "Sucesso",
            text: "Imagem enviada com sucesso!",
            class_name: "gritter"
        });
        //fileItem.remove();
    };
    
    uploader.onWhenAddingFileFailed = function(fileItem){
        $.gritter.add({
            title: "Error",
            text: "Ocorreu ao fazer uploader de imagem!",
            class_name: "gritter"
        });
        console.info("Erro ao adicionar elemento", fileItem);
    };
    
});

app.config(function ($locationProvider) {
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
});
