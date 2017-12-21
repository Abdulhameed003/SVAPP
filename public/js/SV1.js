var app = angular.module('app', ['salesVisionControllers','salesVisionServices','ngRoute','ng-fusioncharts','ngMessages', 'ui.bootstrap', '720kb.datepicker', 'checklist-model']);

app.config(function($routeProvider,$locationProvider) {
        
        $routeProvider.
     
        when('/project', {
            templateUrl: 'pages/project.html',
            controller: 'projectController'
        }).
        when('/company', {
            templateUrl: 'pages/company.html',
            controller: 'mainCtrl'
        }).
        when('/contact', {
            templateUrl: 'pages/contact.html',
            controller: 'mainCtrl'
        }).
        when('/sales', {
            templateUrl: 'pages/salesperson.html',
            controller: 'mainCtrl'
        }).
        when('/dashboard', {
            templateUrl: 'pages/dashboard.html',
            controller: 'dashboardController'
        });
       
        $locationProvider.html5Mode(true);

     });

    (function() {
        
        app.directive('onlyLettersInput', onlyLettersInput);
        
        function onlyLettersInput() {
            return {
                require: 'ngModel',
                link: function(scope, element, attr, ngModelCtrl) {
                    function fromUser(text) {
                        var transformedInput = text.replace(/[^a-zA-Z]/g, '');
                        
                        if (transformedInput !== text) {
                            ngModelCtrl.$setViewValue(transformedInput);
                            ngModelCtrl.$render();
                        }
                        return transformedInput;
                    }
                    ngModelCtrl.$parsers.push(fromUser);
                }
            };
        };
        
    })();

    app.directive('restrictTo', function() {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var re = RegExp(attrs.restrictTo);
                var exclude = /Backspace|Enter|Tab|Delete|Del|ArrowUp|Up|ArrowDown|Down|ArrowLeft|Left|ArrowRight|Right/;

                element[0].addEventListener('keydown', function(event) {
                    if (!exclude.test(event.key) && !re.test(event.key)) {
                        event.preventDefault();
                    }
                });
            }
        }
    });

    var compareTo = function () {
        return {
            require: "ngModel",
            scope: {
                otherModelValue: "=compareTo"
            },
            link: function (scope, element, attributes, ngModel) {

                ngModel.$validators.compareTo = function (modelValue) {
                    return modelValue == scope.otherModelValue;
                };

                scope.$watch("otherModelValue", function () {
                    ngModel.$validate();
                });
            }
        };
    };

    app.directive("compareTo", compareTo);

