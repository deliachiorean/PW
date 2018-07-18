(function () {
    'use strict'
    var app = angular.module('Web', ['ngRoute', 'ngAnimate', 'ngCookies', 'ngAria', 'ngMaterial', 'ngMessages']);

    app.config(function ($routeProvider) {
        $routeProvider
            .when("/landing", {
                templateUrl: "views/LandingPage.html",
                controller: 'LandingController',
                controllerAs: 'ctrl'
            })
            .when("/login", {
                templateUrl: "views/LoginPage.html",
                controller: 'LoginController',
                controllerAs: 'ctrl'
            })
            .when("/main", {
                templateUrl: "views/MainPage.html",
                controller: 'MainController',
                controllerAs: 'ctrl'
            })
            .otherwise({redirectTo: "/landing"});
    });
    app.config(function ($mdThemingProvider) {
        $mdThemingProvider.theme('default')
            .dark();
        $mdThemingProvider.theme('reddrop-toast');
    });
})();