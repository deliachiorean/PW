(function () {
    'use strict'
    var app = angular.module('Register2');
    app.controller('RegisterController2', ['$location', '$cookies', '$scope', '$http', function ($location, $cookies, $scope, $http) {
        var vm = this;

        vm.registerData = $cookies.getObject("registerData");

        vm.saveData = function () {
            $cookies.putObject("registerData", vm.registerData);
        }
        
        vm.previousPage = function () {
            window.history.back();
        }
        
    }]);
})();