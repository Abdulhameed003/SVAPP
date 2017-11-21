angular.module('myApp', ['ui.bootstrap']);
angular.module('myApp').controller('mainCtrl', ['$scope', '$modal', function ($scope, $modal) {
    $scope.open = function (size) {
        var modalInstance = $modal.open({
            controller: 'PopupCont',
            templateUrl: 'forgotpass.html',
            backdrop: "static",
            scope: $scope,
            size:size
        });
    }
}]);

angular.module('myApp').controller('PopupCont', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };
}]);



var moduleC = angular.module("MyModuleC", ['ui.bootstrap']);
moduleC.controller("MyControllerC", function ($scope) {
    $scope.callProject = function () {
        $scope.show = true;
    }

    $scope.resetForm = function (id) {
        if (id == 'filterForm')
            $scope.filterForm = {};

        if (id == 'columnForm')
            $scope.columnForm = {};

    }



    $scope.resetDate = function () {
        $scope.startdate = "";
        $scope.enddate = "";
    }

});



angular.module("MyModuleB", ['ui.bootstrap']);
var moduleB = angular.module("MyModuleB", []);

angular.module("MyModuleB").controller("MyControllerModal", ['$scope', '$modal', function ($scope, $modal) {
    $scope.open = function (size) {
        var modalInstance = $modal.open({
            controller: "forClose",
            templateUrl: 'AddDeal.html',
            backdrop: "static",
            scope: $scope,
            size: size,
        });
    }
}]);

angular.module("MyModuleB").controller("forClose", ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };

}]);


moduleB.controller("MyControllerB", function ($scope) {

});

moduleB.controller("MyControllerB", function ($scope) {

    $scope.callProject = function () {
        $scope.show = true;
    }

    $scope.predicate = 'No';

    $scope.sort = function (predicate) {
        $scope.predicate = predicate;
    }

    $scope.isSorted = function (predicate) {
        return ($scope.predicate == predicate)
    }

    $scope.projects = [{

        No: '5',
        companyName: 'f',
        contactPerson: 's',
        industry: 'f',
        product: 'f',
        value: '1000',
        type: 'renewal',
        category: 'lead',
        startDate: '10/03/2017',
        closingDate: '02/8/2017',
        salesStage: '40%',
        lastUpdate: '22/11/2017',
        pincharge: 'Iulia',
        remarks: 'sdddd'
    }, {
        No: '2',
        companyName: 'z',
        contactPerson: 'q',
        industry: 'p',
        product: 'f',
        value: '300',
        type: 'new sale',
        category: 'deal',
        startDate: '10/03/2016',
        closingDate: '02/8/2020',
        salesStage: '40%',
        lastUpdate: '22/11/2018',
        pincharge: 'Iulia',
        remarks: 'sdddd'
    }
    ];

});

angular.module("MyModuleA", [
    '720kb.datepicker'
]);

