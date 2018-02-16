
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
        var data = {};

      
        return{
            getDetails: function () {
                return data;
            },
            setDetails: function (Details) {
                data = Details;
            },
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
            },function(response){
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

    salesVisionServices.factory('companyService',['$http',function($http){
        function showCompany(onSuccess,onError){
            $http.get('api/company')
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function updateCompany(company_id,onSuccess,onError){
            $http.put("api/company/{{company_id}}")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function deleteCompany(company_id,onSuccess,onError){
            $http.delete("api/company/{{company_id}}")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function showContact(onSuccess,onError){
            $http.get('api/contact')
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function updatecontact(contact_id,onSuccess,onError){
            $http.put("api/contact/{{contact_id}}")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }   
        
        function deleteContact(contact_id,onSuccess,onError){
            $http.delete("api/contact/{{contact_id}}")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        return {
            showCompany:showCompany,
            updateCompany:updateCompany,
            deleteCompany:deleteCompany,
            showContact:showContact,
            updateContact:updatecontact,
            deleteContact:deleteContact
        }
    }]);

    salesVisionServices.factory('salesService',['$http',function($http){
       
        function showSales(onSuccess,onError){
            $http.get('api/salesperson')
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function updateSales(sales_id,onSuccess,onError){
            $http.put("api/salesperson/{{sales_id}}")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function deleteSales(sales_id,onSuccess,onError){
            $http.delete("api/salesperson/{{sales_id}}")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function createSales(formdata,onSuccess,onError){
            $http.post('api/salesperson',formdata)
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }

        function editSales(sales_id,onSuccess,onError){
            $http.get("api/salesperson/{{sales_id}}/edit")
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }    
        return {
            showSales:showSales,
            createSales:createSales,
            editSales:editSales,
            updateSales:updateSales,
            deleteSales:deleteSales
        }
    }]);

    salesVisionServices.factory('dashboardService',['$http',function($http){
        function showDash(onSuccess,onError){
            $http.get('api/dashboard')
            .then(function(response){
                onSuccess(response);
            },function(response){
                onError(response);
            });
        }
      var dashdata={};
        return {
            getDetails: function () {
                return dashdata;
            },
            setDetails: function (Details) {
                dashdata = Details;
            },
            showDash:showDash
        }
    }]);

 