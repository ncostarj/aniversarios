//App.js
(function(){

    var app = angular.module('myApp', []);
    
    app.config(function($interpolateProvider, $httpProvider){

        $httpProvider.defaults.headers.put['Content-Type']  = 'application/x-www-form-urlencoded';
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

        $httpProvider.defaults.transformRequest = function(data){

            if (data === undefined) {
                return data;
            }

            return $.param(data);

        }

        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';

    });    

    app.controller('Mailing',['$http', function($http){

        var vm = this;
        vm.cliente  = {};
        vm.clientes = [];

        vm.listar = function(){

            $http.post('controller.php', vm.cliente).success(function(response) {

                vm.clientes = response;

            });
            
        }


    }]);
})();