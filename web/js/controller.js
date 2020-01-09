var controllers = angular.module('controllers', []);

controllers.controller('MainController', ['$scope', '$location', '$window',
    function ($scope, $location, $window) {
        $scope.loggedIn = function() {
            return Boolean($window.sessionStorage.access_token);
        };
        $scope.logout = function () {
            delete $window.sessionStorage.access_token;
            $location.path('/login').replace();
        };
    }
]);

controllers.controller('SignupController', ['$scope', '$http', '$window', '$location',
    function($scope, $http, $window, $location) {
        $scope.signup = function () {
            $scope.submitted = true;
            $scope.error = {};
            $http.post('web/api/signup', $scope.userModel).then(
                function successCallback(data) {
                    $window.sessionStorage.access_token = data.access_token;
                    $location.path('/hello').replace();
                },
                function errorCallback(data) {
                    angular.forEach(data.data, function (error) {
                        $scope.error[error.field] = error.message;
                    });
                }
            );
        };
    }
]);

controllers.controller('LoginController', ['$scope', '$http', '$window', '$location',
    function($scope, $http, $window, $location) {
        $scope.login = function () {
            $scope.submitted = true;
            $scope.error = {};
            $http.post('web/api/login', $scope.userModel).then(
                function successCallback(data) {
                    $window.sessionStorage.access_token = data.access_token;
                    $location.path('/hello').replace();
                },
                function errorCallback(data) {
                    angular.forEach(data.data, function (error) {
                        $scope.error[error.field] = error.message;
                    });
                }
            );
        };
    }
]);