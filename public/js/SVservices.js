
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



    salesVisionServices.factory('projectService', ['$http', function($http) {
        function getProjects(onSuccess,onError){
            $http.get('api/project')
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function createProject(formdata,onSuccess,onError){
            $http.post('api/project',formdata)
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function updateProject(formdata, onSuccess, onError){
            $http.put("api/project/{{formdata.id}}/edit")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function deleteProject(projectid, onSuccess, onError){
            $http.delete('api/project/'+projectid)
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function loadProjectData(onSuccess, onError){
            $http.get('api/project/create')
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }
        return{
            getProjects: getProjects,
            createProject:createProject,
            deleteProject:deleteProject,
            updateProject:updateProject, 
            loadProjectData:loadProjectData
        }

    }]);

    salesVisionServices.factory('settingService', ['$http', function($http) {
        function showSettings(onSuccess,onError){
            $http.get('api/settings')
            .then(function(response){
                onSuccess(response);
            },function(){
                onError(response);
            });
        }

        function create(formdata, onSuccess, onError){
            $http.post('api/settings/add')
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function deleteIndusty(formdata, onSuccess, onError){
            $http.delete("api/settings/{{formdata}}/industry")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function deleteProduct(formdata, onSuccess, onError){
            $http.delete("api/settings/{{formdata}}/product")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }
        return{
            showSettings:showSettings,
            create:create,
            deleteIndustry:deleteIndusty,
            deleteProduct:deleteProduct
        }
    }]);