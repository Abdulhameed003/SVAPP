

var salesVisionControllers = angular.module('salesVisionControllers', []);

/**Handles registering a new user to the system */
salesVisionControllers.controller('registerController', ['$scope', '$http', 'userService', '$location', '$window', function ($scope, $http, userService, $location, $window) {
    var original = angular.copy($scope.user);
    $scope.error = false;

    $scope.postRegisterform = function (form) {
        if (form.$valid) {
            userService.register($scope.user,
                function (response) {
                    if (response.data == 'success') {
                        $scope.user = angular.copy(original);
                        $scope.signupForm.$setPristine();
                        $scope.signupForm.$setValidity();
                        $scope.signupForm.$setUntouched();
                        window.location = "/login";
                        alert($scope.user.company_name + ' has been successfully registered login with your registed email');
                    }

                },
                function (response) {
                    if (response.status == 422) {
                        $scope.error = true;
                        $scope.errorMessage_CID = response.data.company_id[0];
                    }
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

/**Handles forgot password request by the user*/
salesVisionControllers.controller('forgetPasswordController', ['$scope', '$modal', '$http', 'userService', function ($scope, $modal, $http, userService) {

    $scope.open = function (size) {
        $scope.modalInstance = $modal.open({
            controller: 'forgetPasswordController',
            templateUrl: 'forgotpass.html',
            backdrop: "static",
            scope: $scope,
            size: size
        });
    }


    $scope.close = function () {
        $scope.modalInstance.dismiss('cancel');
    };


    var original = angular.copy($scope.user);
    $scope.emailSubmit = function (form) {

        if (form.$valid) {
            userService.forgotPassword($scope.user, function (response) {
                if (response.status == 200) {
                    $scope.user = angular.copy(original);
                    $scope.forgotpass.$setPristine();
                    $scope.forgotpass.$setValidity();
                    $scope.forgotpass.$setUntouched();

                }
            }, function (response) {
                alert(response.data + 'The was a problem reseting the link');
            });

            alert('A reset link has been sent to ' + $scope.user.email + ' please click the link to rest your password.');
            $scope.modalInstance.dismiss('cancel');


        }
        if (form.$invalid) {

            angular.forEach($scope.forgotpass.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });
        }
    };



}]);

salesVisionControllers.controller('dashboardController', ['$scope', '$http', 'dashboardService', function ($scope, $http, dashboardService) {
    var category = "";
    var projectTitle = "";
    $scope.showdashboard = true;
    $scope.projectTitle = "Dashboard";
    var myEl = angular.element(document.querySelector('#dash'));
    myEl.addClass('active');

    dashboardService.showDash(function (response) {
        if (response.status = 200) {

            dashboardService.setDetails(response.data);
            $scope.content = response.data;

            $scope.totalprogress = $scope.content.frontdash[1].progressToTgt;
            $scope.totaloppvalues = $scope.content.frontdash[2].totalOppVal;
            $scope.totaloppcounts = $scope.content.frontdash[3].totalOppCount;
            $scope.totalwonvalues = $scope.content.frontdash[4].totalWonVal;
            $scope.totalwoncounts = $scope.content.frontdash[5].totalWonCount;
            $scope.totallostvalues = $scope.content.frontdash[6].totalLostVal;
            $scope.totallostcounts = $scope.content.frontdash[7].totalLostCount;


            $scope.totalWonCases.data = $scope.content.totalWonCase;

            $scope.totalRenewals.categories.category = $scope.content.totalRenewals.category;
            $scope.totalRenewals.dataset.data = $scope.content.totalRenewals.data;

            $scope.totalNewsales.categories.category = $scope.content.totalNewsales.category;
            $scope.totalNewsales.dataset.data = $scope.content.totalNewsales.data;

            $scope.totalwonComparison.categories.category = $scope.content.wonOpp.category;
            $scope.totalwonComparison.dataset[0].data = $scope.content.wonOpp.data.totalOpp;
            $scope.totalwonComparison.dataset[1].data = $scope.content.wonOpp.data.wonOpp;

            $scope.QuarterWoncase.categories.category = $scope.content.quarterWonLost.category;
            $scope.QuarterWoncase.dataset[0].data = $scope.content.quarterWonLost.data.won;
            $scope.QuarterWoncase.dataset[1].data = $scope.content.quarterWonLost.data.lost;

            $scope.Salesvaluebycustomers.data = $scope.content.salesByProduct;
            $scope.Salesvaluebyindustry.data = $scope.content.salesByIndustry;

            $scope.totalclosingbyquarter.categories.category = $scope.content.totalCloseOpp.category;
            $scope.totalclosingbyquarter.dataset[0].data = $scope.content.totalCloseOpp.data.deal;
            $scope.totalclosingbyquarter.dataset[1].data = $scope.content.totalCloseOpp.data.lead;


        }
    }, function (response) {
        alert('something went wrong!');
    });

    $scope.totalprogress = '';
    $scope.totaloppvalues = '';
    $scope.totaloppcounts = '';
    $scope.totalwonvalues = '';
    $scope.totalwoncounts = '';
    $scope.totallostvalues = '';
    $scope.totallostcounts = '';

    $scope.totalWonCases = {
        chart: {
            caption: "Won Cases",
            subCaption: "Total Won cases by Values",
            numberPrefix: "RM",
            yAxisName: "Value (in Ringit)",
            theme: "fint",
            paletteColors: "#E53935,#FFEB3B,#4CAF50,#FF9800,#2196F3",
            usePlotGradientColor: "0",
            valueFontColor: "#212121",
            toolTipBgColor: "#263238",
            placeValuesInside: "0",
            bgcolor: "#EEEEEE",
        },
        data: []
    };

    $scope.totalRenewals = {
        chart: {
            caption: " Total Renewals",
            numberPrefix: "RM",
            yAxisName: "Value (in Ringit)",
            paletteColors: "#2196F3,#E53935,#FFEB3B,#4CAF50,#FF9800",
            usePlotGradientColor: "0",
            theme: "fint",
            valueFontColor: "#212121",
            placeValuesInside: "0",
            bgcolor: "#EEEEEE"
        },
        categories: { category: [] },
        dataset: { data: [] }

    };

    $scope.totalNewsales = {
        chart: {
            caption: " Total New Sales",
            numberPrefix: "RM",
            yAxisName: "Value (in Ringit)",
            paletteColors: "#E53935,#FFEB3B,#4CAF50,#FF9800,#2196F3",
            usePlotGradientColor: "0",
            theme: "fint",
            valueFontColor: "#212121",
            placeValuesInside: "0",
            bgcolor: "#EEEEEE"
        },
        categories: { category: [] },
        dataset: { data: [] }

    };

    $scope.totalwonComparison = {
        chart: {
            caption: "Total Opportunities vs Won Cases",
            subCaption: "Last year",
            xAxisname: "Month",
            yAxisName: "Value (In Ringit)",
            numberPrefix: "RM",
            theme: "fint",
            paletteColors: "#4CAF50,#FFEB3B,",
            usePlotGradientColor: "0",
            bgcolor: "#EEEEEE"
        },
        categories: { category: [] },

        dataset: [
            {
                seriesName: "Total Oppotunities",
                data: []
            },
            {
                seriesName: "Won Cases",
                renderAs: "area",
                showValues: "0",
                data: []

            }
        ],


        trendlines: [{
            line: [{
                startvalue: "50000",
                color: "#E53935",
                valueOnRight: "1",
                tooltext: "2017 Target",
                displayvalue: "Target - RM200k"
            }]
        }]

    };

    $scope.QuarterWoncase = {
        chart: {
            caption: "Won Cases vs Lost Cases",
            subCaption: "By Quarters",
            numberPrefix: "RM",
            yAxisName: "Value (In Ringit)",
            theme: "fint",
            paletteColors: "#2196F3,#FF9800",
            usePlotGradientColor: "0",
            valueFontColor: "#212121",
            placeValuesInside: "0",
            bgcolor: "#EEEEEE"
        },
        categories: { category: [] },

        dataset: [
            {
                seriesname: "Won Cases",

                data: []

            },
            {
                seriesname: "Lost Cases",

                data: []

            }]
    };

    $scope.Salesvaluebycustomers = {
        chart: {
            caption: "Sales Value by Customers",
            numberPrefix: "RM",
            theme: "fint",
            showPercentValues: "1",
            showPercentInTooltip: "0",
            decimals: "1",
            //paletteColors: "#3F51B5",
            valueFontColor: "#212121",
            toolTipBgColor: "#263238",
            placeValuesInside: "0",
            showToolTip: "1",
            showLegend: "1",
            useDataPlotColorForLabels: "1",
            bgcolor: "#EEEEEE"
        },
        data: []

    };

    $scope.Salesvaluebyindustry = {
        chart: {
            caption: "Sales Value by Industries",
            numberPrefix: "RM",
            theme: "fint",
            showPercentValues: "1",
            showPercentInTooltip: "0",
            decimals: "1",
            //paletteColors: "#3F51B5",
            valueFontColor: "#212121",
            toolTipBgColor: "#263238",
            placeValuesInside: "0",
            showToolTip: "1",
            showLegend: "1",
            useDataPlotColorForLabels: "1",
            bgcolor: "#EEEEEE"
        },
        data: []

    };

    $scope.totalclosingbyquarter = {
        chart: {
            caption: "Total Closing Opportunities",
            subCaption: "By Quarters",
            numberPrefix: "#",
            theme: "fint",
            xAxisName: "Quarters of year",
            yAxisName: "No. of Total closing Opportunities ",
            //paletteColors: "#3F51B5",
            valueFontColor: "#212121",
            toolTipBgColor: "#263238",
            placeValuesInside: "0",
            showLegend: "1",
            bgcolor: "#EEEEEE"
        },
        categories: { category: [] },
        dataset: [{
            seriesName: "Closing Deals",
            data: []

        }, {
            seriesName: "Closing Leads",
            data: []
        }]

    };

}]);

salesVisionControllers.controller('projectController', ['$scope', '$http', 'projectService', 'moment', function ($scope, $http, projectService, moment) {
    var myE2 = angular.element(document.querySelector('#projnav'));
    myE2.addClass('active');
    var category = "";
    var projectTitle = "";
    var projects = [];
    var onlylead = [];
    var onlydeal = [];
    var onlylostcase = [];
    var duplicateprojects=[];

    var daterangeprojects = [];


    projectService.getProjects(function (response) {
        if (response.status == 200 && response.data.length > 0) {
            this.projects = response.data;
            $scope.searchData = '';
            $scope.rows = this.projects;
            duplicateprojects=this.projects;
            projectService.setDetails($scope.rows);
            $scope.filteredRows = this.projects;

            //pagination
            $scope.checkLength = function () {

                $scope.curPage = 0;

            };

            $scope.curPage = 0;
            $scope.pageSize = 15;
            $scope.numberOfPages = function () {
                return Math.ceil($scope.rows.length / $scope.pageSize);

            };


            $scope.checkboxRule1 = function (checkbox) {
                if (checkbox == 'lead') {
                    $scope.filterForm.deal = false;
                    $scope.filterForm.lostCase = false;
                    $scope.filterForm.date = false;
                }
                if (checkbox == 'deal') {
                    $scope.filterForm.lead = false;
                    $scope.filterForm.lostCase = false;
                    $scope.filterForm.date = false;
                }
                if (checkbox == 'lostCase') {
                    $scope.filterForm.deal = false;
                    $scope.filterForm.lead = false;
                    $scope.filterForm.date = false;
                }
                if (checkbox == 'date') {
                    $scope.filterForm.deal = false;
                    $scope.filterForm.lead = false;
                    $scope.filterForm.lostCase = false;
                }
            };

            /**checkbox names */

            $scope.columns = [
                { id: 1, name: 'Company Name' },
                { id: 2, name: 'Contact Person' },
                { id: 3, name: 'Industry' },
                { id: 4, name: 'Product' },
                { id: 5, name: 'Type' },
                { id: 6, name: 'Value' },
                { id: 7, name: 'Category' },
                { id: 8, name: 'Sales Stage' },
                { id: 9, name: 'Last Update' },
                { id: 10, name: 'Person in Charge' },
                { id: 11, name: 'Start Date' },
                { id: 12, name: 'Closing Date' },
                { id: 13, name: 'Status' },
                { id: 14, name: 'Email' },
                { id: 15, name: 'Phone' },
                { id: 16, name: 'Tender' },
                { id: 17, name: 'Remarks' },
                { id: 18, name: 'PO-Date' },
                { id: 19, name: 'PO-Number' }

            ];


            $scope.columns[0].disabled = true;

            /**define whether the checkboxes should be disable depending on project category */

            $scope.checkCategory = function () {

                $scope.columns[12].disabled = true;
                $scope.columns[15].disabled = true;
                $scope.columns[17].disabled = true;
                $scope.columns[18].disabled = true;
                $scope.columns[9].disabled = true;

                if (category == 'lead') {
                    $scope.columns[17].disabled = true;
                    $scope.columns[18].disabled = true;
                    $scope.columns[12].disabled = false;
                    $scope.columns[15].disabled = false;
                    $scope.columns[9].disabled = false;

                }
                if (category == 'deal') {

                    $scope.columns[12].disabled = true;
                    $scope.columns[15].disabled = true;
                    $scope.columns[17].disabled = false;
                    $scope.columns[18].disabled = false;
                    $scope.columns[9].disabled = false;
                }

            };


            /**filter the table content */
            $scope.filterContent = function () {

                if ($scope.filterForm.lead) {
                    onlylead = [];
                    category = "lead";
                    $scope.projectTitle = "Project Table: Leads Category";
                    //$scope.showprojecttable = true;
                    $scope.colPersonincharge = true;
                    $scope.colStatus = true;
                    $scope.colTender = true;
                    $scope.colContactPerson = true;
                    $scope.colEmail = false;
                    $scope.colPhone = false;
                    $scope.colIndustry = true;
                    $scope.colProduct = true;
                    $scope.colValue = true;
                    $scope.colType = true;
                    $scope.colCategory = true;
                    $scope.colStartdate = true;
                    $scope.colClosingdate = true;
                    $scope.colSalesstage = true;
                    $scope.colLastupdate = true;
                    $scope.colRemarks = true;
                    $scope.colPOnum = false;
                    $scope.colPOdate = false;

                    angular.forEach(response.data, function (value, key) {
                        if (value.project_category == "Lead") {
                            onlylead.push(value);
                        }
                    });
                    $scope.rows = onlylead;
                    $scope.filteredRows = onlylead;
                }

                if ($scope.filterForm.deal) {
                    onlydeal = [];
                    category = "deal";
                    $scope.projectTitle = "Project Table: Deals Category";
                    // $scope.showprojecttable = true;
                    $scope.colPersonincharge = true;
                    $scope.colStatus = false;
                    $scope.colTender = false;
                    $scope.colContactPerson = true;
                    $scope.colEmail = false;
                    $scope.colPhone = false;
                    $scope.colIndustry = true;
                    $scope.colProduct = true;
                    $scope.colValue = true;
                    $scope.colType = true;
                    $scope.colCategory = true;
                    $scope.colStartdate = true;
                    $scope.colClosingdate = true;
                    $scope.colSalesstage = true;
                    $scope.colLastupdate = true;
                    $scope.colRemarks = true;
                    $scope.colPOnum = true;
                    $scope.colPOdate = true;
                    angular.forEach(response.data, function (value, key) {
                        if (value.project_category == "Deal") {
                            onlydeal.push(value);
                        }
                    });
                    $scope.rows = onlydeal;
                    $scope.filteredRows = onlydeal;
                }
                if ($scope.filterForm.lostCase) {
                    onlylostcase = [];
                    category = "lostcase";
                    $scope.projectTitle = "Project Table: Lost Cases Category";
                    //$scope.showprojecttable = true;
                    $scope.colContactPerson = true;
                    $scope.colEmail = false;
                    $scope.colPhone = false;
                    $scope.colIndustry = true;
                    $scope.colProduct = true;
                    $scope.colValue = true;
                    $scope.colType = true;
                    $scope.colCategory = true;
                    $scope.colStartdate = true;
                    $scope.colClosingdate = true;
                    $scope.colSalesstage = true;
                    $scope.colLastupdate = true;
                    $scope.colRemarks = true;
                    $scope.colPOnum = false;
                    $scope.colPOdate = false;
                    $scope.colPersonincharge = false;
                    $scope.colStatus = false;
                    $scope.colTender = false;
                    angular.forEach(response.data, function (value, key) {
                        if (value.project_category == "Lost case") {
                            onlylostcase.push(value);
                        }
                    });
                    $scope.rows = onlylostcase;
                    $scope.filteredRows = onlylostcase;
                }

                if ($scope.filterForm.date) {
                    $scope.rows=duplicateprojects;
                    daterangeprojects=[];
                    var checkrequired = function () {
                        if ($scope.startdate == "" && $scope.enddate == "") {
                            alert("Please fill in both start date and end date");
                        }
                    };
                    checkrequired();

                    var startDate = moment($scope.startdate, 'YYYY-MM-DD').toDate();
                    var endDate = moment($scope.enddate, 'YYYY-MM-DD').toDate();

                    angular.forEach($scope.rows, function (obj) {
                        var testdata = moment.utc(obj.start_date);
                        var testdatab = moment.utc(obj.close_at);
                        if ((moment(testdata).isBetween(startDate, endDate, 'day', '[]')) && (moment(testdatab).isBetween(startDate, endDate, 'day','[]'))){
                       
                        daterangeprojects.push(obj);

                        }
                    });
                    $scope.rows = daterangeprojects;
                    $scope.filteredRows = daterangeprojects;
                }
            };

            $scope.checkempty = function () {
                if (!$scope.filterForm.lead && !$scope.filterForm.deal && !$scope.filterForm.lostCase && !$scope.filterForm.date)
                    alert("Please select the filtering option first.");
            }
            /**filtering table columns */
            var list = [];
            var list1 = [];
            var total = 0;
            var total1 = 0;

            $scope.filtertablecolumns = function (number, list) {

                $scope.list = list;
                total = number;

                $scope.colContactPerson = false;
                $scope.colEmail = false;
                $scope.colPhone = false;
                $scope.colIndustry = false;
                $scope.colProduct = false;
                $scope.colValue = false;
                $scope.colType = false;
                $scope.colCategory = false;
                $scope.colStartdate = false;
                $scope.colClosingdate = false;
                $scope.colSalesstage = false;
                $scope.colLastupdate = false;
                $scope.colRemarks = false;
                $scope.colStatus = false;
                $scope.colTender = false;
                $scope.colPOnum = false;
                $scope.colPersonincharge = false;
                $scope.colPOdate = false;

                for (var i = 0; i < total; i++) {

                    if (list[i] == 2)
                        $scope.colContactPerson = true;

                    if (list[i] == 3)
                        $scope.colIndustry = true;

                    if (list[i] == 4)
                        $scope.colProduct = true;

                    if (list[i] == 5)
                        $scope.colType = true;

                    if (list[i] == 6)
                        $scope.colValue = true;

                    if (list[i] == 7)
                        $scope.colCategory = true;

                    if (list[i] == 8)
                        $scope.colSalesstage = true;

                    if (list[i] == 9)
                        $scope.colLastupdate = true;

                    if (list[i] == 10)
                        $scope.colPersonincharge = true;


                    if (list[i] == 11)
                        $scope.colStartdate = true;

                    if (list[i] == 12)
                        $scope.colClosingdate = true;

                    if (list[i] == 13) {
                        if (category == 'lead')
                            $scope.colStatus = true;
                    }

                    if (list[i] == 14)
                        $scope.colEmail = true;

                    if (list[i] == 15)
                        $scope.colPhone = true;

                    if (list[i] == 16) {
                        if (category == 'lead')
                            $scope.colTender = true;
                    }

                    if (list[i] == 17)
                        $scope.colRemarks = true;

                    if (list[i] == 18) {
                        if (category == 'deal')
                            $scope.colPOnum = true;
                    }

                    if (list[i] == 19) {
                        if (category == 'deal')
                            $scope.colPOdate = true;
                    }

                }


                /** Lead table */
                /** Deal table */
                /** lost cases table */

            };

            $scope.projecttable = {
                projects: []
            };


        } else if (response.data.length == 0) {
            alert('No project found!');
        }


        $scope.projectTitle = "Project Table: All Categories";


        $scope.setTabletoDefault = function () {
            $scope.defaulttable = {
                columns: [1]
            };
            if ((category != 'lead') && (category != 'deal')) {
                $scope.colContactPerson = true;
                $scope.colEmail = false;
                $scope.colPhone = false;
                $scope.colIndustry = true;
                $scope.colProduct = true;
                $scope.colValue = true;
                $scope.colType = true;
                $scope.colCategory = true;
                $scope.colStartdate = true;
                $scope.colClosingdate = true;
                $scope.colSalesstage = true;
                $scope.colLastupdate = true;
                $scope.colRemarks = true;
            }

            if (category == 'lead') {
                $scope.colContactPerson = true;
                $scope.colEmail = false;
                $scope.colPhone = false;
                $scope.colIndustry = true;
                $scope.colProduct = true;
                $scope.colValue = true;
                $scope.colType = true;
                $scope.colCategory = true;
                $scope.colStartdate = true;
                $scope.colClosingdate = true;
                $scope.colSalesstage = true;
                $scope.colLastupdate = true;
                $scope.colRemarks = true;
                $scope.colStatus = true;
                $scope.colPersonincharge = true;
                $scope.colTender = true;
            }


            if (category == 'deal') {
                $scope.colContactPerson = true;
                $scope.colEmail = false;
                $scope.colPhone = false;
                $scope.colIndustry = true;
                $scope.colProduct = true;
                $scope.colValue = true;
                $scope.colType = true;
                $scope.colCategory = true;
                $scope.colStartdate = true;
                $scope.colClosingdate = true;
                $scope.colSalesstage = true;
                $scope.colLastupdate = true;
                $scope.colRemarks = true;
                $scope.colPOdate = true;
                $scope.colPersonincharge = true;
                $scope.colPOnum = true;
            }

        };

        $scope.setTabletoDefault();

        $scope.resetForm = function (id) {
            if (id == 'filterForm')
                $scope.filterForm = {};

            if (id == 'columnForm')
                $scope.defaulttable = {
                    columns: [1]
                };


        }

        $scope.resetDate = function () {
            $scope.startdate = "";
            $scope.enddate = "";
        }

        $scope.setDefault = function () {
            category = "";
            $scope.projectTitle = "Project Table: All Categories";
            var showall = [];
            var allprojects = [];
            allprojects = response.data;
            angular.forEach(allprojects, function (value, key) {

                showall.push(value);

            });
            $scope.rows = showall;
            $scope.filteredRows = showall;

            //$scope.showprojecttable = true;
            $scope.colContactPerson = true;
            $scope.colEmail = false;
            $scope.colPhone = false;
            $scope.colIndustry = true;
            $scope.colProduct = true;
            $scope.colValue = true;
            $scope.colType = true;
            $scope.colCategory = true;
            $scope.colStartdate = true;
            $scope.colClosingdate = true;
            $scope.colSalesstage = true;
            $scope.colLastupdate = true;
            $scope.colRemarks = true;
            $scope.colPOdate = false;
            $scope.colPersonincharge = false;
            $scope.colPOnum = false;
            $scope.colStatus = false;
            $scope.colTender = false;

        };



    }, function (response) {
        alert('There was a problem getting the projects from the database');
    });

}]).filter('pagination', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    };
});

salesVisionControllers.controller('companyController', ['$scope', '$http', 'companyService', function ($scope, $http, companyService) {
    var myE3 = angular.element(document.querySelector('#comnav'));
    myE3.addClass('active');
    var companylist = [];
    companyService.showCompany(function (response) {
        if (response.status == 200 && response.data.length > 0) {
            this.companylist = response.data;
            $scope.searchKeyword = '';
            $scope.rows4 = this.companylist;
            $scope.filteredRows4 = this.companylists;


            $scope.companytable = {
                companylist: []
            };

            $scope.checkLength = function () {

                $scope.curPage = 0;

            };

            $scope.curPage = 0;
            $scope.pageSize = 15;
            $scope.numberOfPages = function () {

                return Math.ceil($scope.rows4.length / $scope.pageSize);

            };
        } else if (response.data.length == 0) {
            alert('No company found!');
        }
    }, function (response) {
        alert('There was a problem getting the companies from the database');
    });


}]).filter('pagination', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    };
});

salesVisionControllers.controller('contactController', ['$scope', '$http', 'companyService', function ($scope, $http, companyService) {
    var myE4 = angular.element(document.querySelector('#contnav'));
    myE4.addClass('active');
    var contacts = [];

    companyService.showContact(function (response) {
        if (response.status == 200 && response.data.length > 0) {
            this.contacts = response.data;
            $scope.searchKeyword1 = '';
            $scope.rows5 = this.contacts;
            $scope.filteredRows5 = this.contacts;
            $scope.checkLength = function () {

                $scope.curPage = 0;

            };

            $scope.curPage = 0;
            $scope.pageSize = 15;
            $scope.numberOfPages = function () {
                return Math.ceil($scope.rows5.length / $scope.pageSize);

            };

            $scope.contacttable = {
                contacts: []
            };
        } else if (response.data.length == 0) {
            alert('No contact found!');
        }
    }, function (response) {
        alert('There was a problem getting the contacts from the database');
    });

}]).filter('pagination', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    };
});


salesVisionControllers.controller('salesController', ['$scope', '$http', 'salesService', function ($scope, $http, salesService) {
    var myE5 = angular.element(document.querySelector('#salesnav'));
    myE5.addClass('active');
    var spersonlist = [];
    salesService.showSales(function (response) {
        if (response.status == 200 && response.data.length > 0) {
            this.spersonlist = response.data;
            $scope.searchKeyword2 = '';
            $scope.rows6 = this.spersonlist;
            $scope.filteredRows6 = this.spersonlist;

            $scope.checkLength = function () {

                $scope.curPage = 0;

            };

            $scope.curPage = 0;
            $scope.pageSize = 15;
            $scope.numberOfPages = function () {
                return Math.ceil($scope.rows6.length / $scope.pageSize);
            };

            $scope.spersontable = {
                spersonlist: []
            };



        } else if (response.data.length == 0) {
            alert('No contact found!');
        }
    }, function (response) {
        alert('There was a problem getting the contacts from the database');
    });
}]).filter('pagination', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    };
});


/**Handles the reset of password when a user forgets his/her details*/

salesVisionControllers.controller('changepassctrl', ['userService', '$location', '$window', function ($scope, userService, $location, $windows) {


    var original = angular.copy($scope.user);
    $scope.postchpassform = function (form) {

        if (form.$valid) {
            userService.resetPassword($scope.user, function (response) {
                if (response.status == 320) {
                    $scope.user = angular.copy(original);
                    $scope.changepassform.$setPristine();
                    $scope.changepassform.$setValidity();
                    $scope.changepassform.$setUntouched();
                    window.location = "/dashboard";
                }
            }, function (response) {
                alert('There was a problem resetting your password.');
            });
        }
        if (form.$invalid) {

            angular.forEach($scope.changepassform.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });

        }


    };
}]);




/**mainpage.html controller */

salesVisionControllers.controller('mainCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.$on('$viewContentLoaded', addCrudControls);

    var myEl = angular.element(document.querySelector('#dash'));
    var myE2 = angular.element(document.querySelector('#projnav'));
    var myE3 = angular.element(document.querySelector('#comnav'));
    var myE4 = angular.element(document.querySelector('#contnav'));
    var myE5 = angular.element(document.querySelector('#salesnav'));


    /**calling the project section */
    $scope.callProject = function () {
        // $scope.showprojecttable = true;
        myEl.removeClass('active');
        myE3.removeClass('active');
        myE4.removeClass('active');
        myE5.removeClass('active');
        $scope.projectTitle = "Project Table: All Categories";
        $location.path('/project');
    };
    /**calling the company section */
    $scope.callCompany = function () {

        myEl.removeClass('active');
        myE2.removeClass('active');
        myE4.removeClass('active');
        myE5.removeClass('active');
        $scope.projectTitle = "Companies Table";
        $location.path('/company');
    };
    /**calling the contact section */
    $scope.callContact = function () {

        myEl.removeClass('active');
        myE2.removeClass('active');
        myE3.removeClass('active');
        myE5.removeClass('active');
        $scope.projectTitle = "Contacts Table";
        $location.path('/contact');
    }
    /**calling the salesperson section */
    $scope.callSalesperson = function () {
        myEl.removeClass('active');
        myE2.removeClass('active');
        myE3.removeClass('active');
        myE4.removeClass('active');
        $scope.projectTitle = "Sales Person Table";
        $location.path('/sales');
    }


    /**calling the dashboard section */
    $scope.callDashboard = function () {
        myE5.removeClass('active');
        myE2.removeClass('active');
        myE3.removeClass('active');
        myE4.removeClass('active');
        $location.path('/dashboard');
    }

    /**Sort table */

    $scope.predicate = 'No';

    $scope.sort = function (predicate) {
        $scope.predicate = predicate;
    }

    $scope.isSorted = function (predicate) {
        return ($scope.predicate == predicate)
    }


}]).filter('pagination', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    };
});





/**modals */


salesVisionControllers.controller('MyControllerModal', ['$scope', '$modal', 'projectService', function ($scope, $modal, projectService) {

    /** nav bar modals */

    $scope.openL = function (size) {
        var modalInstance = $modal.open({
            controller: 'forCloseLead',
            templateUrl: 'leadproject.html',
            backdrop: "static",
            scope: $scope,
            size: size

        });

    }

    $scope.openD = function (size) {
        var modalInstance = $modal.open({
            controller: 'forCloseDeal',
            templateUrl: 'dealproject.html',
            backdrop: "static",
            scope: $scope,
            size: size

        });

    }

    $scope.openchangepassword = function (size) {
        var modalInstance = $modal.open({
            controller: 'forClosePassword',
            templateUrl: 'changepasswordmodal.html',
            backdrop: "static",
            scope: $scope,
            size: size

        });
    }

    $scope.openindustry = function (size) {
        var modalInstance = $modal.open({
            controller: 'forCloseIndustry',
            templateUrl: 'editindustry.html',
            backdrop: "static",
            scope: $scope,
            size: size

        });

    }

    $scope.openproduct = function (size) {
        var modalInstance = $modal.open({
            controller: 'forCloseProduct',
            templateUrl: 'editproduct.html',
            backdrop: "static",
            scope: $scope,
            size: size

        });

    }
    /**not required for now 
        $scope.opencontact = function (size) {
            var modalInstance = $modal.open({
                controller: 'forCloseContact',
                templateUrl: 'addcontact.html',
                backdrop: "static",
                scope: $scope,
                size: size
    
            });
    
    
        }*/

    $scope.opensalesperson = function (size) {
        var modalInstance = $modal.open({
            controller: 'forCloseSalesperson',
            templateUrl: 'addsalesperson.html',
            backdrop: "static",
            scope: $scope,
            size: size

        });



    };

    /** project modals */
    $scope.openDelete = function (size, proj) {
        var modalInstance = $modal.open({
            controller: 'forCloseDelete',
            templateUrl: 'delete.html',
            backdrop: "static",
            scope: $scope,
            size: size,

        });
        modalInstance.id = proj;
    };


    $scope.openmultipledelete = function (list) {
        if ($scope.projecttable.projects == 0) {
            var modalInstance = $modal.open({
                controller: 'forCloseMultipledeleteErrormessage',
                templateUrl: 'multipledelete2.html',
                backdrop: "static",
                scope: $scope,
                size: 'sm',

            });
        }
        else {
            var modalInstance = $modal.open({
                controller: 'forCloseMultipledelete',
                templateUrl: 'multipledelete.html',
                backdrop: "static",
                scope: $scope,
                size: 'sm',

            });
            modalInstance.list = list;
        }
    };

    $scope.openEdit = function (size, proj) {
        projectService.setid(proj.id);
        if (proj.project_category == 'Lead') {
            var modalInstance = $modal.open({
                controller: 'forCloseEditlead',
                templateUrl: 'editlead.html',
                backdrop: "static",
                scope: $scope,
                size: size,

            });
            modalInstance.leadproject = proj;

        }
        if (proj.project_category == 'Deal') {
            var modalInstance = $modal.open({
                controller: 'forCloseEditdeal',
                templateUrl: 'editdeal.html',
                backdrop: "static",
                scope: $scope,
                size: size,

            });
            modalInstance.dealproject = proj;
        }
        if (proj.project_category == 'Lost case') {
            var modalInstance = $modal.open({
                controller: 'forCloseEditlostcase',
                templateUrl: 'editlostcase.html',
                backdrop: "static",
                scope: $scope,
                size: size,

            });
            modalInstance.lostcaseproject = proj;
        }


    };
    /**Company modals */
    $scope.openEditcomp = function (size, company) {
        var modalInstance = $modal.open({
            controller: 'forCloseEditcomp',
            templateUrl: 'editcompany.html',
            backdrop: "static",
            scope: $scope,
            size: size,

        });
        modalInstance.comlist = company;
    };

    $scope.openDeletecomp = function (size, company) {
        var modalInstance = $modal.open({
            controller: 'forCloseDeletecomp',
            templateUrl: 'delete.html',
            backdrop: "static",
            scope: $scope,
            size: size,

        });
        modalInstance.comlist = company;
    };

    $scope.openmultiplecompanydelete = function (comlist) {
        if ($scope.companytable.companylist == 0) {
            var modalInstance = $modal.open({
                controller: 'forCloseMultipledeletecompErrormessage',
                templateUrl: 'multipledelete2.html',
                backdrop: "static",
                scope: $scope,
                size: 'sm',

            });
        }
        else {
            var modalInstance = $modal.open({
                controller: 'forCloseMultiplecompdelete',
                templateUrl: 'multipledelete.html',
                backdrop: "static",
                scope: $scope,
                size: 'sm',

            });
        }
        modalInstance.list = comlist;


    };

    /**contact modals */
    $scope.openEditcont = function (size, contact) {

        var modalInstance = $modal.open({
            controller: 'forCloseEditcont',
            templateUrl: 'editcontact.html',
            backdrop: "static",
            scope: $scope,
            size: size,

        });
        modalInstance.contlist = contact;
    };

    $scope.openDeletecont = function (size, contact) {
        var modalInstance = $modal.open({
            controller: 'forCloseDeletecont',
            templateUrl: 'delete.html',
            backdrop: "static",
            scope: $scope,
            size: size,

        });
        modalInstance.contlist = contact;
    };

    $scope.openmultiplecontactdelete = function (contlist) {
        if ($scope.contacttable.contacts == 0) {
            var modalInstance = $modal.open({
                controller: 'forCloseMultipledeletecontErrormessage',
                templateUrl: 'multipledelete2.html',
                backdrop: "static",
                scope: $scope,
                size: 'sm',

            });
        }
        else {
            var modalInstance = $modal.open({
                controller: 'forCloseMultiplecontdelete',
                templateUrl: 'multipledelete.html',
                backdrop: "static",
                scope: $scope,
                size: 'sm',

            });
        }
        modalInstance.list = contlist;
    };

    /**salesperson modals */
    $scope.openEditsperson = function (size, sperson) {
        var modalInstance = $modal.open({
            controller: 'forCloseEditpers',
            templateUrl: 'editsalesperson.html',
            backdrop: "static",
            scope: $scope,
            size: size,

        });
        modalInstance.list = sperson;
    };

    $scope.openDeletesperson = function (size, sperson) {
        var modalInstance = $modal.open({
            controller: 'forCloseDeletepers',
            templateUrl: 'delete.html',
            backdrop: "static",
            scope: $scope,
            size: size,

        });
        modalInstance.list = sperson;
    };

    $scope.openmultiplespersondelete = function (perslist) {
        if ($scope.spersontable.spersonlist == 0) {
            var modalInstance = $modal.open({
                controller: 'forCloseMultipledeletepersErrormessage',
                templateUrl: 'multipledelete2.html',
                backdrop: "static",
                scope: $scope,
                size: 'sm',

            });
        }
        else {
            var modalInstance = $modal.open({
                controller: 'forCloseMultiplepersdelete',
                templateUrl: 'multipledelete.html',
                backdrop: "static",
                scope: $scope,
                size: 'sm',

            });
        }
        modalInstance.list = perslist;
    };



}]);




/** modal controllers */


/** project modal controllers */
salesVisionControllers.controller('forCloseLead', ['$scope', '$modalInstance', 'projectService', function ($scope, $modalInstance, projectService) {
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };

    projectService.loadProjectData(function (response) {

        $scope.companies = response.data.company;
        $scope.industryList = response.data.industry;
        $scope.productList = response.data.product;
        $scope.salespersonList = response.data.salesperson;

        $scope.leadproj = {
            project_category: "Lead"
        };



        $scope.types = [
            {
                "id": "1",
                "name": "New Sale"
            },
            {
                "id": "2",
                "name": "Renewal"
            }

        ];

        $scope.statuses = [
            {
                "id": "1",
                "name": "In progress"
            },
            {
                "id": "2",
                "name": "Successful"
            },
            {
                "id": "3",
                "name": "Terminated"
            }


        ];

        $scope.tenders = [{
            name: 'Yes',
            id: 0
        }, {
            name: 'No',
            id: 1
        }, {
            name: 'Possibly',
            id: 2
        }
        ];
    }, function (response) {
        alert('No predefined data are set for industires, company and products');
    });
    var original = angular.copy($scope.leadproj);
    $scope.foraddnewcompany = false;
    $scope.watchselect = function () {

        if ($scope.showAdd == true) {
            $scope.foraddnewcompany = true;

        }
        else {
            $scope.foraddnewcompany = false;

        }
    }

    $scope.postAddLeadForm = function (form) {
        if (form.$valid) {
            // alert('can submit');
            projectService.createProject($scope.leadproj, function (response) {
                if (response.status == 200) {
                    alert('Project created succesfully');
                    projectService.getDetails().push(response.data[0]);
                    // $scope.leadproj = angular.copy(original);
                    // $scope.addLead.$setPristine();
                    // $scope.addLead.$setValidity();
                    // $scope.addLead.$setUntouched();

                }
            }, function (response) {
                var error = response.data;
                alert('There was problem creating project');
            });

            $scope.close();
        }

        if (form.$invalid) {

            angular.forEach($scope.addLead.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });

        }


    };

    $scope.resetSelect = function () {
        $scope.leadproj.company_name = $scope.default;
        $scope.addLead.addCompanyName.$setUntouched();
        $scope.addLead.companyWebsite.$setUntouched();
        $scope.addLead.companyPhone.$setUntouched();
        $scope.addLead.industry.$setUntouched();
        $scope.addLead.contactPerson.$setUntouched();
        $scope.addLead.contPerEmail.$setUntouched();
        $scope.addLead.contPerPhone.$setUntouched();
        $scope.addLead.contPerPos.$setUntouched();
        $scope.leadproj.website = '';
        $scope.leadproj.office_number = '';
        $scope.leadproj.contact_name = '';
        $scope.leadproj.contact_email = '';
        $scope.leadproj.contact_number = '';
        $scope.leadproj.contact_designation = '';
    };


}]);

salesVisionControllers.controller('forCloseDeal', ['$scope', '$modalInstance', 'projectService', function ($scope, $modalInstance, projectService) {
    projectService.loadProjectData(function (response) {

        $scope.companies = response.data.company;
        $scope.industryList = response.data.industry;
        $scope.productList = response.data.product;
        $scope.salespersonList = response.data.salesperson;

        $scope.Dealproj = {
            project_category: "Deal"
        };

        $scope.types = [
            {
                "id": "1",
                "name": "New Sale"
            },
            {
                "id": "2",
                "name": "Renewal"
            }


        ];


    }, function (response) {
        alert('No predefined data are set for industires, company and products');
    });


    var original = angular.copy($scope.Dealproj);
    $scope.foraddnewcompany = false;
    $scope.watchselectDeal = function () {

        if ($scope.showAddDeal == true) {
            $scope.foraddnewcompany = true;

        }
        else {
            $scope.foraddnewcompany = false;

        }
    };

    $scope.postAddDealForm = function (form) {


        if (form.$valid) {
            projectService.createProject($scope.Dealproj, function (response) {
                if (response.status != 'failed') {
                    alert('Project created succesfully');
                    //push data to table
                    projectService.getDetails().push(response.data[0]);
                    //$scope.Dealproj = angular.copy(original);
                    //$scope.addDeal.$setPristine();
                    //$scope.addDeal.$setValidity();
                    //$scope.addDeal.$setUntouched();


                }
            }, function (response) {
                var error = response.data;
                alert('There was problem creating project');
            });

            $scope.close();
        }
        if (form.$invalid) {

            angular.forEach($scope.addDeal.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });

        }


    };

    $scope.resetSelect = function () {
        $scope.Dealproj.company_name = $scope.default;
        $scope.addDeal.addCompanyName.$setUntouched();
        $scope.addDeal.companyWebsite.$setUntouched();
        $scope.addDeal.companyPhone.$setUntouched();
        $scope.addDeal.industry.$setUntouched();
        $scope.addDeal.contactPerson.$setUntouched();
        $scope.addDeal.contPerEmail.$setUntouched();
        $scope.addDeal.contPerPhone.$setUntouched();
        $scope.addDeal.contPerPos.$setUntouched();
        $scope.Dealproj.website = '';
        $scope.Dealproj.office_number = '';
        $scope.Dealproj.contact_name = '';
        $scope.Dealproj.contact_email = '';
        $scope.Dealproj.contact_number = '';
        $scope.Dealproj.contact_designation = '';
    };


    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };

}]);

salesVisionControllers.controller('forCloseDelete', ['$scope', '$modalInstance', 'projectService', function ($scope, $modalInstance, projectService) {
    $scope.deleteHeader = "Delete a Project";
    $scope.deleteTitle = "Are you sure to delete this project?";
    var indexid = $modalInstance.id.id;


    $scope.removeRow = function () {
        projectService.deleteProject(indexid, function (response) {
            if (response.status == 200) {
                var currentid = $modalInstance.id;
                var index = $scope.rows.indexOf(currentid);
                $scope.rows.splice(index, 1);

            }
        }, function (response) {
            alert('There was an error deleting the selected project');
        });

    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);



salesVisionControllers.controller('forClosePassword', ['$scope', '$modalInstance', 'settingService', function ($scope, $modalInstance, settingService) {

    var original = angular.copy($scope.user);
    $scope.postchpassformin = function (form) {

        if (form.$valid) {
            settingService.changePass($scope.user, function (response) {
                if (response.data == 'success') {
                    alert('Password successfully changed ');
                } else if (response.data == 'failed') {
                    alert('There was an error in your request.');
                }
            }, function (response) {
                alert('server down! We will get back to you shortly');
            });

            $scope.user = angular.copy(original);
            $scope.changepassformin.$setPristine();
            $scope.changepassformin.$setValidity();
            $scope.changepassformin.$setUntouched();
            $modalInstance.dismiss('cancel');
        }
        if (form.$invalid) {

            angular.forEach($scope.changepassformin.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });

        }
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

/**This controller manageges the Industry section of the system it helps to DELETE AND SHOW the industry list*/
salesVisionControllers.controller('forCloseIndustry', ['$scope', '$modalInstance', 'settingService', function ($scope, $modalInstance, settingService) {

    settingService.showSettings(function (response) {
        $scope.industryList = response.data.industry;
    }, function (response) {
        alert('Error in loading industries');
    });

    $scope.addIndustry = function (industry) {
        settingService.create(industry, function (response) {
            if (response.data != "failed") {
                $scope.industryList.push(response.data);

            } else {
                alert('Something went wrong.');
            }
        }, function (response) {
            alert("Please don't leave the field empty");
        });
    };

    $scope.deleteSelected = function (index, industry) {
        settingService.deleteIndustry(industry.id, function (response) {
            if (response.status == 200) {
                $scope.industryList.splice(index, 1);
                aleart('Industry has been deleted');
            }
        }, function (response) {
            alert('Erorr deleting the selected industry.');
        });

    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };

}]);

/**Handles the product section of the system which enbles the management of products in the system. */
salesVisionControllers.controller('forCloseProduct', ['$scope', '$modalInstance', 'settingService', function ($scope, $modalInstance, settingService) {
    settingService.showSettings(function (response) {
        $scope.productList = response.data.product;
    }, function (response) {
        alert('Error in loading product');
    });

    $scope.addProduct = function (product) {
        settingService.create(product, function (response) {
            if (response.data != "failed") {
                $scope.productList.push(response.data);

            } else {
                alert('Something went wrong.');
            }
        }, function (response) {
            alert("Please don't leave the field empty");
        });
    };


    $scope.deleteSelected = function (index, product) {

        settingService.deleteProduct(product.id, function (response) {
            if (response.status == 200) {
                $scope.productList.splice(index, 1);
                aleart('product has been deleted.');
            }
        }, function (response) {
            alert('Erorr deleting the selected product.');
        });

    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

salesVisionControllers.controller('forCloseEditlead', ['$scope', '$modalInstance', 'projectService', function ($scope, $modalInstance, projectService) {
    projectService.loadProjectData(function (response) {

        $scope.productList = response.data.product;
        $scope.salespersonList = response.data.salesperson;

        $scope.editLeadProj = {
            company_name: $modalInstance.leadproject.company.company_name,
            project_type: $modalInstance.leadproject.project_type,
            product: $modalInstance.leadproject.product.id,
            value: $modalInstance.leadproject.value,
            sales_stage: $modalInstance.leadproject.sales_stage,
            start_date: $modalInstance.leadproject.start_date,
            close_at: $modalInstance.leadproject.close_at,
            status: $modalInstance.leadproject.status,
            tender: $modalInstance.leadproject.tender,
            remarks: $modalInstance.leadproject.remarks,
            salesperson_id: $modalInstance.leadproject.salesperson.salesperson_id,
            project_category: $modalInstance.leadproject.project_category
        };



        $scope.statuses = [
            {
                "id": "1",
                "name": "In progress"
            },
            {
                "id": "2",
                "name": "Successful"
            },
            {
                "id": "3",
                "name": "Terminated"
            }


        ];

        $scope.types = [
            {
                "id": "1",
                "name": "New Sale"
            },
            {
                "id": "2",
                "name": "Renewal"
            }

        ];



        $scope.cats = [{
            "id": "0",
            "name": "Lead"
        },
        {
            "id": "1",
            "name": "Deal"
        },
        {
            "id": "2",
            "name": "Lost case"
        }

        ];

        $scope.tenders = [{
            name: 'Yes',
            id: 0
        }, {
            name: 'No',
            id: 1
        }, {
            name: 'Possibly',
            id: 2
        }
        ];
        $scope.checkdeal = false;

        $scope.selectedItemChanged = function () {
            if ($scope.editLeadProj.project_category == "Deal") {
                alert('deal is selected');
                $scope.checkdeal = true;
            }
            else if ($scope.editLeadProj.project_category != "Deal") {
                $scope.checkdeal = false;
                $scope.editLead.podate.$setUntouched();
                // $scope.editLead.podate.$setValidity();
                // $scope.editLead.podate.$setPristine();
                $scope.editLead.ponumber.$setUntouched();
                //$scope.editLead.ponumber.$setValidity();
                // $scope.editLead.ponumber.$setPristine();
                $scope.editLeadProj.ponumber = '';
                $scope.editLeadProj.podate = '';
            }



            if ($scope.editLeadProj.project_category != "Lead") {
                // $scope.editLead.tender.$setUntouched();
                // $scope.editLead.tender.$setValidity();
                // $scope.editLead.tender.$setPristine();
                // $scope.editLead.statusID.$setUntouched();
                // $scope.editLead.statusID.$setValidity();
                // $scope.editLead.statusID.$setPristine();
            }

            if ($scope.editLeadProj.project_category != "Lost case") {
                // $scope.editLead.salesPerson.$setUntouched();
                //$scope.editLead.salesPersonr.$setValidity();
                // $scope.editLead.salesPerson.$setPristine();

            }




        };

    }, function (response) {
        alert('No predefined data are set for industires, company and products');
    });


    var original = angular.copy($scope.editLeadProj);

    $scope.editLeadRow = function (form) {
        /**call to update database */
        if (form.$valid) {
            projectService.updateProject($scope.editLeadProj, function (response) {
                if (response.status == 200) {
                    alert('Updated successfully');
                }
            }, function (response) {
                alert('Error editting the project.');
            });
            $scope.editLeadProj = angular.copy(original);
            $scope.editLead.$setPristine();
            $scope.editLead.$setValidity();
            $scope.editLead.$setUntouched();
            $modalInstance.dismiss('cancel');
        }
        if (form.$invalid) {
            alert('invalid');
            angular.forEach($scope.editLead.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });
        }
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };




}]);



salesVisionControllers.controller('forCloseEditdeal', ['$scope', '$modalInstance', 'projectService', function ($scope, $modalInstance, projectService) {
    projectService.loadProjectData(function (response) {

        $scope.productList = response.data.product;
        $scope.salespersonList = response.data.salesperson;


        $scope.editDealProj = {
            company_name: $modalInstance.dealproject.company.company_name,
            salesperson_id: $modalInstance.dealproject.salesperson.salesperson_id,
            project_type: $modalInstance.dealproject.project_type,
            product: $modalInstance.dealproject.product.id,
            value: $modalInstance.dealproject.value,
            sales_stage: $modalInstance.dealproject.sales_stage,
            remarks: $modalInstance.dealproject.remarks,
            po_num: $modalInstance.dealproject.deal.po_num,
            po_date: $modalInstance.dealproject.deal.po_date,
            start_date: $modalInstance.dealproject.start_date,
            close_at: $modalInstance.dealproject.close_at
        };

        $scope.types = [
            {
                "id": "1",
                "name": "New sale"
            },
            {
                "id": "2",
                "name": "Renewal"
            }

        ];
    }, function (response) {
        alert('No predefined data are set for industires, company and products');
    });

    var original = angular.copy($scope.editDealProj);
    $scope.editDealRow = function (form) {
        /**call to update database */
        if (form.$valid) {
            projectService.updateProject($scope.editDealProj, function (response) {
                if (response.status == 200) {
                    alert('Updated successfully');
                    $modalInstance.dismiss('cancel');
                }
            }, function (response) {
                alert('Error editting the project.');
            });

        }
        if (form.$invalid) {

            angular.forEach($scope.editDeal.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });
        }
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);


salesVisionControllers.controller('forCloseEditlostcase', ['$scope', '$modalInstance', 'projectService', function ($scope, $modalInstance, projectService) {
    projectService.loadProjectData(function (response) {

        $scope.productList = response.data.product;


        $scope.editlostProj = {
            company_name: $modalInstance.lostcaseproject.company.company_name,
            project_type: $modalInstance.lostcaseproject.project_type,
            product: $modalInstance.lostcaseproject.product.id,
            value: $modalInstance.lostcaseproject.value,
            start_date: $modalInstance.lostcaseproject.start_date,
            close_at: $modalInstance.lostcaseproject.close_at,
            remarks: $modalInstance.lostcaseproject.remarks
        }


        $scope.types = [
            {
                "id": "1",
                "name": "New sales"
            },
            {
                "id": "2",
                "name": "Renewals"
            }

        ];
    }, function (response) {
        alert('No predefined data are set for industires, company and products');
    });

    var original = angular.copy($scope.editLostProj);
    $scope.editLostRow = function (form) {
        /**call to update database */
        if (form.$valid) {
            projectService.updateProject($scope.editLostProj, function (response) {
                if (response.status == 200) {
                    alert('Updated successfully');
                    $modalInstance.dismiss('cancel');
                }
            }, function (response) {
                alert('Error editting the project.');
            });
            $scope.editLostProj = angular.copy(original);
            $scope.editlostcase.$setPristine();
            $scope.editlostcase.$setValidity();
            $scope.editlostcase.$setUntouched();

        }
        if (form.$invalid) {

            angular.forEach($scope.editlostcase.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });
        }
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);


salesVisionControllers.controller('forCloseSalesperson', ['$scope', '$modalInstance', function ($scope, $modalInstance) {

    var original = angular.copy($scope.Sperson);
    $scope.postAddSalesPerson = function (form) {

        if (form.$valid) {
            alert('can submit');
            $scope.Sperson = angular.copy(original);
            $scope.addSalespersonform.$setPristine();
            $scope.addSalespersonform.$setValidity();
            $scope.addSalespersonform.$setUntouched();

        }
        if (form.$invalid) {

            angular.forEach($scope.addSalespersonform.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });

        }


    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

salesVisionControllers.controller('forCloseMultipledelete', ['$scope', '$modalInstance', 'projectService', function ($scope, $modalInstance, projectService) {
    $scope.deleteHeaderrows = "Delete Projects";
    $scope.deleteMessage = "Are you sure to delete the selected projects?";


    $scope.removeSelectedRows = function () {
        var rows = $modalInstance.list;
        var numbers = $modalInstance.list.length;
        for (var i = 0; i < numbers; i++) {
            angular.forEach($scope.rows, function (value) {
                if (value.id == rows[i]) {
                    var indexid = rows[i];
                    projectService.deleteProject(indexid, function (response) {
                        if (response.status == 200) {
                            var index = $scope.rows.indexOf(value);
                            $scope.rows.splice(index, 1);
                        }
                    }, function (response) {
                        alert('There was an error deleting the selected project');
                    });
                }
            });
        }

    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
        $scope.projecttable.projects = 0;
    };


}]);

salesVisionControllers.controller('forCloseMultipledeleteErrormessage', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeaderrows = "Delete Projects";
    $scope.deleteErrorMessage = "No project is selected. Please select the projects first.";
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

/**contact modal controllers */
salesVisionControllers.controller('forCloseEditcont', ['$scope', '$modalInstance', 'companyService', function ($scope, $modalInstance, companyService) {
    companyService.setid($modalInstance.contlist.id);
    $scope.editcont = {
        company_id: $modalInstance.contlist.id,
        company_name: $modalInstance.contlist.company.company_name,
        contact_name: $modalInstance.contlist.contact_name,
        contact_number: $modalInstance.contlist.contact_number,
        contact_email: $modalInstance.contlist.email,
        contact_designation: $modalInstance.contlist.designation
    };

    var original = angular.copy($scope.editcont);
    $scope.postEditContact = function (form) {

        if (form.$valid) {
            // alert('can submit');
            companyService.updateContact($scope.editcont, function (response) {
                if (response.status == 200) {
                    alert('Updated successfully');
                    // $scope.editcont = angular.copy(original);
                    // $scope.editContact.$setPristine();
                    // $scope.editContact.$setValidity();
                    // $scope.editContact.$setUntouched();
                    $modalInstance.dismiss('cancel');
                }
            }, function (response) {
                alert('Error editting the contact.');
            });


        }
        if (form.$invalid) {

            angular.forEach($scope.editContact.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });

        }
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

salesVisionControllers.controller('forCloseDeletecont', ['$scope', '$modalInstance', 'companyService', function ($scope, $modalInstance, companyService) {
    $scope.deleteHeader = "Delete a Contact";
    $scope.deleteTitle = "Are you sure to delete this contact?";
    var indexid = $modalInstance.contlist.id;

    $scope.removeRow = function () {
        companyService.deleteContact(indexid, function (response) {
            if (response.status == 200) {
                var currentid = $modalInstance.contlist;
                var index = $scope.rows5.indexOf(currentid);
                $scope.rows5.splice(index, 1);
            }
        }, function (response) {
            alert('There was an error deleting the selected company');
        });
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

salesVisionControllers.controller('forCloseMultipledeletecontErrormessage', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeaderrows = "Delete a Contact";
    $scope.deleteErrorMessage = "No contact is selected. Please select the contacts first.";
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

salesVisionControllers.controller('forCloseMultiplecontdelete', ['$scope', '$modalInstance', 'companyService', function ($scope, $modalInstance, companyService) {
    $scope.deleteHeaderrows = "Delete Contacts";
    $scope.deleteMessage = "Are you sure to delete the selected contacts?";

    $scope.removeSelectedRows = function () {
        var rows = $modalInstance.list;
        var numbers = $modalInstance.list.length;
        for (var i = 0; i < numbers; i++) {
            angular.forEach($scope.rows5, function (value) {
                if (value.id == rows[i]) {
                    var indexid = rows[i];
                    companyService.deleteContact(indexid, function (response) {
                        if (response.status == 200) {
                            var index = $scope.rows5.indexOf(value);
                            $scope.rows5.splice(index, 1);
                        }
                    }, function (response) {
                        alert('There was an error deleting the selected contacts');
                    });
                }

            });
        }

    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
        $scope.contacttable.contacts = 0;
    };


}]);

/**company modal controllers */
salesVisionControllers.controller('forCloseEditcomp', ['$scope', '$modalInstance', 'settingService', 'companyService', function ($scope, $modalInstance, settingService, companyService) {
    settingService.showSettings(function (response) {
        $scope.industryList = response.data.industry;
        $scope.editcom = {
            company_name: $modalInstance.comlist.company_name,
            website: $modalInstance.comlist.website,
            office_num: $modalInstance.comlist.office_num,
            industry_id: $modalInstance.comlist.industry.id
        }


        $scope.close = function () {
            $modalInstance.dismiss('cancel');
        };
    }, function (response) {
        alert('No predefined data are set for industires, company and products');
    });
    var original = angular.copy($scope.editcom);
    $scope.postEditCompany = function (form) {

        if (form.$valid) {
            alert('can submit');
            $scope.editcom = angular.copy(original);
            $scope.editcompany.$setPristine();
            $scope.editcompany.$setValidity();
            $scope.editcompany.$setUntouched();

        }
        if (form.$invalid) {

            angular.forEach($scope.editcompany.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });

        }


    };

}]);

salesVisionControllers.controller('forCloseDeletecomp', ['$scope', '$modalInstance', 'companyService', function ($scope, $modalInstance, companyService) {
    $scope.deleteHeader = "Delete a Company";
    $scope.deleteTitle = "Deleting this company will delete all the related projects and contacts. Do you want to proceed?";
    var indexid = $modalInstance.comlist.id;
    $scope.removeRow = function () {
        companyService.deleteCompany(indexid, function (response) {
            if (response.status == 200) {
                var currentid = $modalInstance.comlist;
                var index = $scope.rows4.indexOf(currentid);
                $scope.rows4.splice(index, 1);
            }
        }, function (response) {
            alert('There was an error deleting the selected company');
        });



    };
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };

}]);


salesVisionControllers.controller('forCloseMultipledeletecompErrormessage', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeaderrows = "Delete Companies";
    $scope.deleteErrorMessage = "No company is selected. Please select the companies first.";
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);


salesVisionControllers.controller('forCloseMultiplecompdelete', ['$scope', '$modalInstance', 'companyService', function ($scope, $modalInstance, companyService) {
    $scope.deleteHeaderrows = "Delete Companies";
    $scope.deleteMessage = "Deleting these companies will delete all the related project and contacts. Do you want to proceed?";

    $scope.removeSelectedRows = function () {
        var rows = $modalInstance.list;
        var numbers = $modalInstance.list.length;
        for (var i = 0; i < numbers; i++) {
            angular.forEach($scope.rows4, function (value) {
                if (value.id == rows[i]) {
                    var indexid = rows[i];
                    companyService.deleteCompany(indexid, function (response) {
                        if (response.status == 200) {
                            var index = $scope.rows4.indexOf(value);
                            $scope.rows4.splice(index, 1);
                        }
                    }, function (response) {
                        alert('There was an error deleting the selected companies');
                    });


                }

            });
        }
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
        $scope.companytable.rows4 = 0;
    };


}]);



/**company modal controllers */
salesVisionControllers.controller('forCloseEditpers', ['$scope', '$modalInstance', function ($scope, $modalInstance) {

    if (isEditable) {
        $scope.editSperson = {
            name: $modalInstance.list.name,
            phone_num: $modalInstance.list.phone_num,
            email: $modalInstance.list.email,
            salesperson_id: $modalInstance.list.salesperson_id,
            position: $modalInstance.list.position
        }
    }


    var original = angular.copy($scope.editSperson);
    $scope.editPersRow = function (form) {
        /**call to update database */
        if (form.$valid) {
            alert('can submit');
            $scope.editSperson = angular.copy(original);
            $scope.editsalesperson.$setPristine();
            $scope.editsalesperson.$setValidity();
            $scope.editsalesperson.$setUntouched();

        }
        if (form.$invalid) {

            angular.forEach($scope.editsalesperson.$error, function (field) {
                angular.forEach(field, function (errorField) {
                    errorField.$setTouched();
                })
            });
        }
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

salesVisionControllers.controller('forCloseDeletepers', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeader = "Delete a Sales Person";
    $scope.deleteTitle = "Are you sure to delete this sales person?";
    $scope.removeRow = function () {
        var currentid = $modalInstance.list;
        var index = $scope.rows6.indexOf(currentid);
        $scope.rows6.splice(index, 1);
    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);


salesVisionControllers.controller('forCloseMultipledeletepersErrormessage', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeaderrows = "Delete Sales Persons";
    $scope.deleteErrorMessage = "No sales person is selected. Please select the sales persons first.";
    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);


salesVisionControllers.controller('forCloseMultiplepersdelete', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeaderrows = "Delete Sales Persons";
    $scope.deleteMessage = "Are you sure to delete the selected sales persons?";

    $scope.removeSelectedRows = function () {
        var rows = $modalInstance.list;
        var numbers = $modalInstance.list.length;
        for (var i = 0; i < numbers; i++) {
            angular.forEach($scope.rows6, function (value) {
                if (value.No == rows[i]) {
                    var index = $scope.rows6.indexOf(value);
                    $scope.rows6.splice(index, 1);
                }


            });
        }

    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
        $scope.spersontable.rows6 = 0;
    };


}]);


