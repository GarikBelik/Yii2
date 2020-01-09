var app = angular.module("app", ['ngRoute', 'controllers']);
            
app.config(['$routeProvider', '$locationProvider',
    function ($routeProvider, $locationProvider) {
        $locationProvider.hashPrefix('');
        $routeProvider
        
        .when('/', {
            templateUrl: 'views/index.html',
        }) 
        .when('/signup', {
            templateUrl: 'views/signup.html',
            controller: 'SignupController'
        }) 
        .when('/login', {
            templateUrl: 'views/login.html',
            controller: 'LoginController'
        })
        .when('/hello', {
            templateUrl: 'views/hello.html'
        })
        .otherwise({   
            templateUrl: 'views/404.html'
        });
    }
]);