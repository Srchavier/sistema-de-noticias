var app = angular.module('app', ['angular-loading-bar', 'angularFileUpload']);

app.controller('gerenciarImagensControle', function ($scope, $http, $location, FileUploader) {

    $scope.noticia = {};
    $scope.imagens = {};

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

    $scope.getImagens = function (idImagem) {
        $http.get('../api/listarImagens/' + idImagem)
            .success(function (data) {
                $scope.imagens = data.imagens;
            })
            .error(function () {
                $.gritter.add({
                    title: "Error",
                    text: "Ocorreu ao fazer getNoticia!",
                    class_name: "gritter"
                });
            });
    };

    $scope.excImagem = function (idImagem) {
        if (!confirm('Tem certeza que deseja excluir?')) return false;

        $http.get('../api/excluirImagem/' + idImagem)
            .success(function (data) {
                $.gritter.add({
                    title: "Imagem Exclúida",
                    text: "sucesso!",
                    class_name: "gritter"
                });
                $scope.getImagens($location.search().idnoticia);
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
    $scope.getImagens($location.search().idnoticia);

    var uploader = $scope.uploader = new FileUploader({
        url: '../api/cadastrarImagem/' + $location.search().idnoticia
    });

    uploader.filters.push({
        name: "tamanhoFila",
        fn: function (item, options) {
            return this.queue.length < 4;
        }
    });

    uploader.onBeforeUploadItem = function (item) {
        item.formData.push({
            imagemtitulo: item.imagemtitulo
        });
    };

    uploader.onSuccessItem = function (fileItem) {
        $.gritter.add({
            title: "Sucesso",
            text: "Imagem enviada com sucesso!",
            class_name: "gritter"
        });
        $scope.getImagens($location.search().idnoticia);
        //fileItem.remove();
    };

    uploader.onWhenAddingFileFailed = function (fileItem) {
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
