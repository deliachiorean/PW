(function () {
    'use strict'
    var app = angular.module('Register1');
    app.controller('RegisterController1', ['$location', '$cookies', '$scope', '$http', function ($location, $cookies, $scope, $http) {
        var vm = this;

        vm.registerData = $cookies.getObject("registerData");

        vm.saveData = function () {
            $cookies.putObject("registerData", vm.registerData);
        };

        if (!vm.registerData) {
            vm.registerData = {};
            vm.saveData();
        }
        
    }]);
})();