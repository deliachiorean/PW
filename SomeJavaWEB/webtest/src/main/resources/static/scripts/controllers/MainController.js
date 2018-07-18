(function () {
    'use strict'
    var app = angular.module('Web');
    app.controller('MainController', ['$location', '$cookies', '$scope', '$http', '$mdDialog', function ($location, $cookies, $scope, $http, $mdDialog) {
        var vm = this;

        vm.userToken = $cookies.get("userToken");

        if (!vm.userToken) {
            $location.path("/login");
        }

        vm.sortType = 'username';

        vm.logout = function () {
            $cookies.remove("userToken");
            vm.userToken = undefined;
            $location.path("/login");
        };

        vm.deleteUser = function () {
            $.ajax({
                type: "POST",
                url: "/api/user/delete",
                data: JSON.stringify({
                    "token": vm.userToken
                }),
                contentType: "application/json; charset=utf-8",
                success: function (response) {
                    $cookies.remove("userToken");
                    vm.userToken = undefined;
                    $location.path("/login");
                    $scope.$apply();
                }
            });
        };

        vm.showImage = function(username) {

            $cookies.put("showImg", username);

            $mdDialog.show({
                controller: function ($cookies) {

                    var vm = this;

                    vm.username = $cookies.get("showImg");
                    vm.asd = 2;
                },
                controllerAs: 'ctrl',
                templateUrl: '/views/ImgDialog.html',
                parent: angular.element(document.body),
                clickOutsideToClose: true
            });
        };

        vm.refreshUsers = function () {
            $.ajax({
                type: "POST",
                url: "/api/user/getlast3",
                data: JSON.stringify({
                    "token": vm.userToken
                }),
                contentType: "application/json; charset=utf-8",
                success: function (response) {
                    vm.users = response;
                    $scope.$apply();
                }
            });
        };

        vm.refreshUsers();

    }]);
})();