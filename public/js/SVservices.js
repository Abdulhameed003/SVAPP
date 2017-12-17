
var salesVisionServices = angular.module('salesVisionServices',['LocalStorageModule']);

salesVisionServices.factory('userService', ['$http', 'localStorageService', function($http, localStorageService) {
    
        function checkIfLoggedIn() {
    
            if(localStorageService.get('token'))
                return true;
            else
                return false;
                
        }
    
        function register(formdata, onSuccess, onError) {
           
            $http.post('/register',formdata)
            .then(function(response) {
    
                localStorageService.set('token', response.data.token);
                onSuccess(response);
    
            }, function(response) {
    
                onError(response);
    
            });
    
        }
    
        function login(formdata, onSuccess, onError){
    
            $http.post('/login',formdata).
            then(function(response) {
    
                localStorageService.set('token', response.data.token);
                onSuccess(response);
                
            }, function(response) {
    
                onError(response);
    
            });
    
        }
    
        function logout(){
    
            localStorageService.remove('token');
    
        }
    
        function getCurrentToken(){
            return localStorageService.get('token');
        }
    
        return {
            checkIfLoggedIn: checkIfLoggedIn,
            register: register,
            login: login,
            logout: logout,
            getCurrentToken: getCurrentToken
        }
    
    }]);