(function () {
    'use strict'
    var app = angular.module('Register3');
    app.controller('RegisterController3', ['$location', '$cookies', '$scope', '$http', function ($location, $cookies, $scope, $http) {
        var vm = this;

        vm.registerData = {};
        vm.registerData = $cookies.getObject("registerData");

        vm.saveData = function () {
            $cookies.putObject("registerData", vm.registerData);
        };
        
        vm.previousPage = function () {
            window.history.back();
        };

        $scope.uploadFile = function(files) {
            vm.registerData.theFile = files[0];
            vm.saveData();
        };

        vm.finishRegister = function () {
            var fd = new FormData();

            for (var i in vm.registerData) {
                fd.append(i, vm.registerData[i]);
            }

            $http.post("/api/user/register", fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).then(function (value) {
                $scope.$apply();
            }, function (reason) {  });
        };

    }]);
})();