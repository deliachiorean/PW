(function(){
    'use strict'
    var app = angular.module('Web');
    app.controller('LoginController', ['$location', '$cookies', '$scope', function($location, $cookies, $scope)
    {
        var vm = this;

        vm.username = "";
        vm.password = "";

        vm.login = function () {
            $.ajax({
                type: "POST",
                url: "/api/user/login",
                data: JSON.stringify({
                    "username": vm.username,
                    "password": vm.password
                }),
                contentType: "application/json; charset=utf-8",
                success: function (response) {
                    if (response.successful) {
                        $cookies.put("userToken", response.token);
                        $location.path("/main");
                        $scope.$apply();
                    } else {
                        alert("Invalid login data");
                    }
                }
            });
        };
    }]);
})();