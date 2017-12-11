

var SalesVisionController = angular.module('SalesVisionController',[]);

SalesVisionController.controller('LoginController', ['$scope', '$http','userService', function ($scope, $http, userService) {
        userService.register($scope.user,
            function(response){
                alert( $scope.user.company_name +' has been successfully registered login with your registed email');
            },
            function(response){
                scope.error = response.data.error;
            });
    }]);
    
    bookWishlistAppControllers.controller('RegisterController', ['$scope', '$http', function ($scope, $http) {
        
    }]);
    
    bookWishlistAppControllers.controller('MainController', ['$scope', '$http', function ($scope, $http) {
        
    }]);