(function () {
    'use strict'
    var app = angular.module('Web');
    app.controller('LandingController', ['$location', '$cookies', '$scope', '$http', function ($location, $cookies, $scope, $http) {
        var vm = this;

        vm.userToken = $cookies.get("userToken");

        vm.goToLoginPage = function () {
            $location.path("/login");
        };

        vm.logout = function () {
            $cookies.remove("userToken");
            vm.userToken = undefined;
        };

        $scope.uploadFile = function(files) {
            vm.theFile = files[0];
        };
        
        vm.changeUser = function () {
            var fd = new FormData();
            //Take the first selected file
            fd.append("file", vm.theFile);
            fd.append("password", vm.password);
            fd.append("user", vm.userToken);

            $http.post("/api/user/change", fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            });
        };
        
        vm.getAvatarURL = function () {
            return "/api/user/image?name=" + vm.userToken;
        };

        vm.selectQuestion = function (question) {
            if (vm.selectedQuestion == question.uuid) {
                vm.selectedQuestion = "";
            } else {
                vm.selectedQuestion = question.uuid;
                vm.answers = [];
                vm.getAnswers(question);
            }
        };

        vm.getAnswers = function (question) {
            $.ajax({
                type: "POST",
                url: "/api/answer/getfor",
                data: JSON.stringify({
                    "token": question.uuid
                }),
                contentType: "application/json; charset=utf-8",
                success: function (response) {
                    vm.answers = response;
                    $scope.$apply();
                }
            });
        };

        vm.refreshQuestions = function () {
            $.ajax({
                type: "GET",
                url: "/api/question/getall",
                success: function (response) {
                    vm.questions = response;
                    $scope.$apply();
                }
            });
        };

        vm.addQuestion = function () {
            $.ajax({
                type: "POST",
                url: "/api/question/add",
                data: JSON.stringify({
                    "question": vm.question,
                    "author": vm.userToken
                }),
                contentType: "application/json; charset=utf-8",
                success: function (response) {
                    vm.questions.push(response);
                    $scope.$apply();
                }
            });
        };

        vm.addAnswer = function (question) {
            $.ajax({
                type: "POST",
                url: "/api/answer/add",
                data: JSON.stringify({
                    "question": question.uuid,
                    "author": vm.userToken,
                    "answer": vm.answer
                }),
                contentType: "application/json; charset=utf-8",
                success: function (response) {
                    vm.answers.push(response);
                    $scope.$apply();
                }
            });
        };

        vm.refreshQuestions();

    }]);
})();