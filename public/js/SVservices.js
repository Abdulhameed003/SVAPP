var SalesVisionServices = angular.module('SalesVisionServices',[]);

SalesVisionServices.factory('userService', ['$http', 'localStorageService', function($http, localStorageService) {
    
        function checkIfLoggedIn() {
    
            if(localStorageService.get('token'))
                return true;
            else
                return false;
    
        }
    
        function register(formdata, onSuccess, onError) {
    
            $http.post('/register', 
            {
                first_name: formdata.first_name,
                last_name: formdata.last_name,
                email: formdata.email,
                password: formdata.password,
                password_confirmation: formdata.password_confirmation,
                company_id:formdata.company_id,
                company_name:formdata.company_name,
                company_number:formdata.company_number
            }).
            then(function(response) {
    
                localStorageService.set('token', response.data.token);
                onSuccess(response);
    
            }, function(response) {
    
                onError(response);
    
            });
    
        }
    
        function login(formdata, onSuccess, onError){
    
            $http.post('/login', 
            {
                company_id:formdata.company_id,
                email: formdata.email,
                password: formdata.password
            }).
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
            signup: signup,
            login: login,
            logout: logout,
            getCurrentToken: getCurrentToken
        }
    
    }]);