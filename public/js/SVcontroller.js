

var salesVisionControllers = angular.module('salesVisionControllers',[]);

salesVisionControllers.controller('LoginController', ['$scope', '$http','userService', function ($scope, $http, userService) {
        
           
    }]);
    
    salesVisionControllers.controller('RegisterController', ['$scope', '$http','userService', function ($scope, $http, userService) {
        var original = angular.copy($scope.user);
        $scope.postRegisterform = function (form) {
            
            if (form.$valid) {
                userService.register($scope.user,
                    function(response){
                        alert( $scope.user.company_name +' has been successfully registered login with your registed email');
                        $scope.user = angular.copy(original);
                        $scope.signupForm.$setPristine();
                        $scope.signupForm.$setValidity();
                        $scope.signupForm.$setUntouched();
                    },
                    function(response){
                        scope.error = response.data.error;
                });

               

            }
            if (form.$invalid) {

                angular.forEach($scope.signupForm.$error, function (field) {
                    angular.forEach(field, function (errorField) {
                        errorField.$setTouched();
                    })
                });

            }


        };
    }]);
    
    salesVisionControllers.controller('MainController', ['$scope', '$http', function ($scope, $http) {
        
    }]);