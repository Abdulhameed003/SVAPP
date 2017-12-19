
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
        
        function forgotPassword(formdata, onSuccess,onError){
            $http.post('/password/email',formdata)
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function resetPassword(){
            $http.post('/password/reset',formdata)
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

    
        function getCurrentToken(){
            return localStorageService.get('token');
        }
    
        return {
            checkIfLoggedIn: checkIfLoggedIn,
            register: register,
            forgotPassword: forgotPassword,
            resetPassword: resetPassword,
            getCurrentToken: getCurrentToken
        }
    
    }]);



    salesVisionServices.factory('appService', ['$http', function($http) {
        function getProjects(onSuccess,onError){
            $http.get('/project')
            .then(function(response){
                onSuccess(response);
            },function(){
                onError(response);
            });
        }

        function createProject(formdata,onSuccess,onError){
            $http.post('/project',formdata)
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        return{
            getProjects: getProjects,
            createProject:createProject,
           
        }

    }]);