

var salesVisionControllers = angular.module('salesVisionControllers',[]);


    salesVisionControllers.controller('registerController', ['$scope', '$http','userService','$location','$window', function ($scope, $http, userService,$location,$window) {
        var original = angular.copy($scope.user);
        $scope.error = false;
    
        $scope.postRegisterform = function (form) {
            if (form.$valid) {
                userService.register($scope.user,
                    function(response){
                        if(response.data== 'success'){
                            $scope.user = angular.copy(original);
                            $scope.signupForm.$setPristine();
                            $scope.signupForm.$setValidity();
                            $scope.signupForm.$setUntouched();
                            window.location = "/login";
                            alert( $scope.user.company_name +' has been successfully registered login with your registed email');
                        }
                        
                    },
                    function(response){
                        if(response.status==422){
                            $scope.error =true;
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
    
    salesVisionControllers.controller('forgetPasswordController', ['$scope', '$modal', function ($scope, $modal) {
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
    
        $scope.emailSubmit = function(){
    
            $scope.modalInstance.dismiss('cancel');
        };
    
    }]);

    salesVisionControllers.controller('dashboardController', ['$scope', '$http', function ($scope, $http) {
        var category = "";
        var projectTitle = "";
        $scope.showdashboard = true;
        $scope.projectTitle = "Dashboard";
        var myEl = angular.element(document.querySelector('#dash'));
        myEl.addClass('active');
    
        test = [
            {label: "Total New Sales",
             value: "138000"},
    
            {label: "Total Renewals",
             value: "602000"}
        ];
    
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
            data: test
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
            categories: [{
                category: [{
                    label: "Office 365"
                }, {
                    label: "Cloud SVR"
                }, {
                    label: "Broadband"
                }, {
                    label: "HRM"
                }]
            }],
            dataset: [{
                data: [{
                    value: "6000"
                }, {
                    value: "12800"
                }, {
                    value: "18000"
                }, {
                    value: "19000"
                }]
    
            }]
    
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
            categories: [{
                category: [{
                    label: "Office 365"
                }, {
                    label: "Cloud SVR"
                }, {
                    label: "Broadband"
                }, {
                    label: "HRM"
                }]
            }],
            dataset: [{
                data: [{
                    value: "3000"
                }, {
                    value: "6800"
                }, {
                    value: "10000"
                }, {
                    value: "19000"
                }]
    
            }]
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
            categories: [{
                category: [{
                    label: "Jan"
                }, {
                    label: "Feb"
                }, {
                    label: "Mar"
                }, {
                    label: "Apr"
                }, {
                    label: "May"
                }, {
                    label: "Jun"
                }, {
                    label: "Jul"
                }, {
                    label: "Aug"
                }, {
                    label: "Sep"
                }, {
                    label: "Oct"
                }, {
                    label: "Nov"
                }, {
                    label: "Dec"
                }]
            }],
            dataset: [{
                seriesName: "Total Oppotunities",
                data: [{
                    value: "16000"
                }, {
                    value: "20000"
                }, {
                    value: "18000"
                }, {
                    value: "19000"
                }, {
                    value: "15000"
                }, {
                    value: "21000"
                }, {
                    value: "16000"
                }, {
                    value: "20000"
                }, {
                    value: "17000"
                }, {
                    value: "25000"
                }, {
                    value: "19000"
                }, {
                    value: "23000"
                }]
            }, {
                seriesName: "Won Cases",
                renderAs: "area",
                showValues: "0",
                data: [{
                    value: "4000"
                }, {
                    value: "5000"
                }, {
                    value: "3000"
                }, {
                    value: "4000"
                }, {
                    value: "1000"
                }, {
                    value: "7000"
                }, {
                    value: "1000"
                }, {
                    value: "4000"
                }, {
                    value: "1000"
                }, {
                    value: "8000"
                }, {
                    value: "2000"
                }, {
                    value: "7000"
                }]
            }],
            data: [{
    
                value: "2000"
            },
            {
    
                value: "8000"
            },
            {
    
                value: "4500"
            },
            {
    
                value: "24000"
            }],
    
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
            categories: [{
                category: [{
                    label: "Q1"
                }, {
                    label: "Q2"
                }, {
                    label: "Q3"
                }, {
                    label: "Q4"
                }]
            }],
            dataset: [
                {
                    seriesname: "Won Cases",
    
                    data: [{
    
                        value: "2000"
                    },
                    {
    
                        value: "8000"
                    },
                    {
    
                        value: "4500"
                    },
                    {
    
                        value: "24000"
                    }]
                },
                {
                    seriesname: "Lost Cases",
    
                    data: [{
    
                        value: "500"
                    },
                    {
    
                        value: "8400"
                    },
                    {
    
                        value: "100"
                    },
                    {
    
                        value: "5000"
                    }]
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
            data: [{
                label: "Office 365",
                value: "2000"
            },
            {
                label: "Cloud SVR",
                value: "8000"
            },
            {
                label: "Broadband",
                value: "4500"
            },
            {
                label: "HRM",
                value: "24000"
            }]
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
            data: [{
                label: "Reseller",
                value: "2000"
            },
            {
                label: "Health",
                value: "24000"
            },
            {
                label: "Education",
                value: "4500"
            },
            {
                label: "Retail",
                value: "5000"
            }]
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
            data: [{
                label: "Q1",
                value: "5"
            },
            {
                label: "Q2",
                value: "10"
            },
            {
                label: "Q3",
                value: "1"
            },
            {
                label: "Q4",
                value: "12"
            }]
        };
    }]);

    salesVisionControllers.controller('projectController', ['$scope', '$http','projectService', function ($scope, $http, projectService) {
        var category = "";
        var projectTitle = "";
        var projects=[];

        projectService.getProjects(function(response){
            if(response.status == 200 && response.data.length > 0){
                this.projects = response.data;
                $scope.searchData = '';
                $scope.rows = this.projects;
                $scope.filteredRows = this.projects;

            }else if (response.data.length == 0){
                alert('No project found!');
            }
        },function(response){
            alert('There was a problem getting the projects from the database');
        });

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

        /*var projects = [{
            
                    No: 1,
                    companyName: 'University Kebangsaan',
                    contactPerson: 'Shaharom',
                    email: '',
                    phone: '012-950 4084',
                    industry: 'Education',
                    product: 'Cloud Svr',
                    value: 'N/A',
                    type: 'New Sales',
                    category: 'Lead',
                    startDate: '03/01/2017',
                    closingDate: '',
                    salesStage: '10%',
                    lastUpdate: '16/01/2017',
                    pincharge: 'Iulia',
                    remarks: ' 15/1 - Scoping for requirement'
            
                 }, {
                    No: 2,
                    companyName: 'Pengurusan Air Selangor Sdn Bhd',
                    contactPerson: 'Raja Ahmad Hidzir',
                    email: '',
                    phone: '123777131',
                    industry: 'Hospitality/Services',
                    product: 'HRM',
                    value: '1600000.00',
                    type: ' New Sales ',
                    category: 'Lead',
                    startDate: '24/02/2017',
                    closingDate: '',
                    salesStage: '20%',
                    lastUpdate: '04/05/2017',
                    remarks: '*Group head human resource admin meet up *Meeting initiated'
                    },
            
                 {
                    No: 3,
                    companyName: 'Numa Solution',
                    contactPerson: 'Aizuddin',
                    email: 'aizzuddin@numasolution.com',
                    phone: '0322842500 ',
                    industry: 'Reseller',
                    product: 'Co-Lo',
                    value: '6360.00',
                    type: 'New Sales',
                    category: 'Lead',
                    startDate: '06/02/2017',
                    closingDate: '01/05/2017',
                    salesStage: '50%',
                    lastUpdate: '10/02/2017',
                    remarks: '06/02 - Site visit10/02 - Quoted'
                    },
                    {
                    No: 4,
                    companyName: 'Abeam Consulting',
                    contactPerson: 'See Mun',
                    email: 'sleong@abeam.com',
                    phone: '0162553311',
                    industry: 'HOSPITALITY / SERVICES',
                    product: 'Cloud Svr',
                    value: ' 37,468.00',
                    type: 'Renewal',
                    category: 'Deal',
                    startDate: '01/05/2017',
                    closingDate: '01/07/2017',
                    salesStage: '100%',
                    lastUpdate: '29/06/2017',
                    remarks: ''
                    },
                    {
                    No: 5,
                    companyName: 'Cornerstone',
                    contactPerson: 'Victoria',
                    email: 'victoria@cstone.com.my',
                    phone: '03-7725 2120',
                    industry: 'Industrial',
                    product: 'HW/SW',
                    value: ' 500.00',
                    type: 'New Sales',
                    category: 'Deal',
                    startDate: '27/01/2017',
                    closingDate: '01/02/2017',
                    salesStage: '100%',
                    lastUpdate: '27/01/2017',
                    remarks: '27/02 - PO Received.'
                    },
                    {
                    No: 6,
                    companyName: 'Alfredo Biagio',
                    contactPerson: 'Alfredo',
                    email: 'a.biagio@vfemail.net',
                    phone: '946803116',
                    industry: 'Hospitality/Services',
                    product: 'Cloud Svr',
                    value: ' 5,760.00',
                    type: 'New Sales',
                    category: 'Deal',
                    startDate: '23/10/2016',
                    closingDate: '02/8/2020',
                    salesStage: '100%',
                    lastUpdate: '21/12/2016',
                    remarks: '23/10 - Scoping requirement. Gathering customer background information. 21/12 - Quoting '
                    },
                    {
                    No: 7,
                    companyName: 'E-Treasure BPO',
                    contactPerson: 'Kelvin Silva',
                    email: 'kelvin092108@yahoo.com',
                    phone: '039238025443',
                    industry: 'Telecommunication',
                    product: 'Co-Lo',
                    value: '51516.00',
                    type: 'New Sales',
                    category: 'Lost Case',
                    startDate: '10/02/2017',
                    closingDate: 'N/A',
                    salesStage: '10%',
                    lastUpdate: '10/02/2017',
                    remarks: '10/02 - Required 1rack, 20 IP, 3Mbps of Colo - Competitor'
                    },
                    {
                    No: 8,
                    companyName: 'PeopleQuest (Risda)',
                    contactPerson: 'Yew',
                    email: 'th.yew@peoplequest.com.my',
                    phone: '0162381726',
                    industry: 'GOV / GLC',
                    product: 'Cloud Svr',
                    value: '110000.00',
                    type: 'new sale',
                    category: 'Lost Case',
                    startDate: '12/11/2016',
                    closingDate: '01/02/2027',
                    salesStage: '50%',
                    lastUpdate: '06/02/2017',
                    remarks: '10/12 - Scoping for requirement. 13/12 - Quoting Peoplequest.- Yew lost the deal to HR2000.'
                 }
        ];*/

        //pagination


        $scope.checkLength = function () {
            
                    $scope.curPage = 0;
            
                };
            
                $scope.curPage = 0;
                $scope.pageSize = 11;
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
    
    
        $scope.setDefault = function () {
            category = "";
            $scope.projectTitle = "Project Table: All Categories";
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
    
        /**filter the table content */
        $scope.filterContent = function () {
    
            if ($scope.filterForm.lead) {
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
    
            }
    
            if ($scope.filterForm.deal) {
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
    
    
            }
            if ($scope.filterForm.lostCase) {
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
    
            }
        };
    
    
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



        $scope.update = function(){
            projectService.updateProject($scope.project,function(response){
                if (response.data == 'success'){
                    alert('Project updated succesfully');
                }
            },function(response){
                var error = response.data;
                alert(error);
            });
        };

        $scope.delete = function(){
            projectService.deleteProject($scope.project, function(response){
                if(response.status == 200){
                    alert('project has been delete');
                }
            },function(response){
                var error= response.data;
                alert(error);
            });
        };
    
    }]).filter('pagination', function () {
        return function (input, start) {
            start = +start;
            return input.slice(start);
        };
    });

    salesVisionControllers.controller('companyController', ['$scope', '$http','appService', function ($scope, $http, projectService) {
        
    }]);

    salesVisionControllers.controller('contactController', ['$scope', '$http','appService', function ($scope, $http, projectService) {
        
    }]);

    salesVisionControllers.controller('salesController', ['$scope', '$http','appService', function ($scope, $http, projectService) {
        
    }]);

    salesVisionControllers.controller('settingsController', ['$scope', '$http','appService', function ($scope, $http, projectService) {
        
    }]);
    
/**Changepassword.html controller */

salesVisionControllers.controller('changepassctrl', function ($scope) {
    
    
                var original = angular.copy($scope.user);
                $scope.postchpassform = function (form) {
    
                    if (form.$valid) {
                        alert('can submit');
                        $scope.user = angular.copy(original);
                        $scope.changepassform.$setPristine();
                        $scope.changepassform.$setValidity();
                        $scope.changepassform.$setUntouched();
    
                    }
                    if (form.$invalid) {
    
                        angular.forEach($scope.changepassform.$error, function (field) {
                            angular.forEach(field, function (errorField) {
                                errorField.$setTouched();
                            })
                        });
    
                    }
    
    
                };
});




/**mainpage.html controller */

salesVisionControllers.controller('mainCtrl',['$scope','$location', function ($scope, $location) {
    $scope.$on('$viewContentLoaded', addCrudControls);


    var myEl = angular.element(document.querySelector('#dash'));

    
    /**calling the project section */
    $scope.callProject = function () {
       // $scope.showprojecttable = true;
        myEl.removeClass('active');
        $scope.projectTitle = "Project Table: All Categories";
        $location.path('/project');
    };
    /**calling the company section */
    $scope.callCompany = function () {

        myEl.removeClass('active');
        $scope.projectTitle = "Companies Table";
        $location.path('/company');
    };
    /**calling the contact section */
    $scope.callContact = function () {

        myEl.removeClass('active');
        $scope.projectTitle = "Contacts Table";
        $location.path('/contact');
    }
    /**calling the salesperson section */
    $scope.callSalesperson = function () {
        myEl.removeClass('active');
        $scope.projectTitle = "Sales Person Table";
        $location.path('/sales');
    }


    /**calling the dashboard section */
    $scope.callDashboard = function () {

        $location.path('/dashboard');
    }




    /**reseting forms */


    /**Sort table */

    $scope.predicate = 'No';

    $scope.sort = function (predicate) {
        $scope.predicate = predicate;
    }

    $scope.isSorted = function (predicate) {
        return ($scope.predicate == predicate)
    }


    //dummy data

    var companylist = [{

            No: 1,
            companyName: 'University Kebangsaan',
            contactPerson: 'Shaharom',
            website: '',
            phone: '',
            industry: 'Education',
            address: ''

        }, {
            No: 2,
            companyName: 'Pengurusan Air Selangor Sdn Bhd',
            contactPerson: 'Raja Ahmad Hidzir',
            website: '',
            phone: '',
            industry: 'Hospitality/Services',
            address: ''
        },

        {
            No: 3,
            companyName: 'Numa Solution',
            contactPerson: 'Aizuddin',
            website: '',
            phone: '',
            industry: 'Reseller',
            address: ''
        },
        {
            No: 4,
            companyName: 'Abeam Consulting',
            contactPerson: 'See Mun',
            website: '',
            phone: '',
            industry: 'HOSPITALITY / SERVICES',
            address: ''
        },
        {
            No: 5,
            companyName: 'Cornerstone',
            contactPerson: 'Victoria',
            website: '',
            phone: '',
            industry: 'Industrial',
            address: ''
        },
        {
            No: 6,
            companyName: 'Alfredo Biagio',
            contactPerson: 'Alfredo',
            website: '',
            phone: '',
            industry: 'Hospitality/Services',
            address: ''
        },
        {
            No: 7,
            companyName: 'E-Treasure BPO',
            contactPerson: 'Kelvin Silva',
            website: '',
            phone: '',
            industry: 'Telecommunication',
            address: ''
        }, {
            No: 8,
            companyName: 'PeopleQuest (Risda)',
            contactPerson: 'Yew',
            website: '',
            phone: '',
            industry: 'GOV / GLC',
            address: ''
        }
    ];

    var contacts = [{

            No: 1,
            companyName: 'University Kebangsaan',
            name: 'Shaharom',
            phone: '',
            email: '',
            position: ''

        }, {
            No: 2,
            companyName: 'Pengurusan Air Selangor Sdn Bhd',
            name: 'Raja Ahmad Hidzir',
            phone: '',
            email: '',
            position: ''

        },

        {
            No: 3,
            companyName: 'Numa Solution',
            name: 'Aizuddin',
            phone: '',
            email: 'aizzuddin@numasolution.com',
            position: ''

        },
        {
            No: 4,
            companyName: 'Abeam Consulting',
            name: 'See Mun',
            phone: '',
            email: 'sleong@abeam.com',
            position: ''

        },
        {
            No: 5,
            companyName: 'Cornerstone',
            name: 'Victoria',
            phone: '',
            email: 'victoria@cstone.com.my',
            position: ''

        },
        {
            No: 6,
            companyName: 'Alfredo Biagio',
            name: 'Alfredo',
            phone: '',
            email: 'a.biagio@vfemail.net',
            position: ''

        },
        {
            No: 7,
            companyName: 'E-Treasure BPO',
            name: 'Kelvin Silva',
            phone: '',
            email: 'kelvin092108@yahoo.com',
            position: ''

        }, {
            No: 8,
            companyName: 'PeopleQuest (Risda)',
            name: 'Yew',
            phone: '',
            email: 'th.yew@peoplequest.com.my',
            position: ''
        }
        ];

         var sperson = [{
            No:'1',
            name: 'Iulia',
            phone: '',
            email: '',
            position: 'Business development manager',
            total: '8'
        }];


  



    


    //pagination


    $scope.searchKeyword = '';
    $scope.rows4 = companylist;
    $scope.filteredRows4 = companylist;

    $scope.searchKeyword1 = '';
    $scope.rows5 = contacts;
    $scope.filteredRows5 = contacts;

    $scope.searchKeyword2 = '';
    $scope.rows6 = sperson;
    $scope.filteredRows6 = sperson;

 



  


    $scope.checkLength = function () {

        $scope.curPage = 0;

    };

    $scope.curPage = 0;
    $scope.pageSize = 11;
    $scope.numberOfPages = function () {
  
        return Math.ceil($scope.rows4.length / $scope.pageSize);
        return Math.ceil($scope.rows5.length / $scope.pageSize);
        return Math.ceil($scope.rows6.length / $scope.pageSize);
    };

    $scope.companytable = {
        companylist: []
    };
    $scope.contacttable = {
        contacts: []
    };

    $scope.spersontable = {
        spersonlist: []
    };

}]).filter('pagination', function () {
    return function (input, start) {
        start = +start;
        return input.slice(start);
    };
});





    /**modals */


    salesVisionControllers.controller('MyControllerModal', ['$scope', '$modal', function ($scope, $modal) {

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
            if (proj.category == 'Lead') {
                var modalInstance = $modal.open({
                    controller: 'forCloseEditlead',
                    templateUrl: 'editlead.html',
                    backdrop: "static",
                    scope: $scope,
                    size: size,

                });
                modalInstance.leadproject = proj;
            }
            if (proj.category == 'Deal') {
                var modalInstance = $modal.open({
                    controller: 'forCloseEditdeal',
                    templateUrl: 'editdeal.html',
                    backdrop: "static",
                    scope: $scope,
                    size: size,

                });
                modalInstance.dealproject = proj;
            }
            if (proj.category == 'Lost case') {
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
    salesVisionControllers.controller('forCloseLead', ['$scope', '$modalInstance','projectService', function ($scope, $modalInstance, projectService) {
        projectService.loadProjectData(function(response){
            $scope.companies = response.data.company;
            $scope.industry = respons.data.industry;
            $scope.product = response.data.product;
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
                    id:0
                }, {
                    name: 'No',
                    id:1
                }, {
                    name: 'Possibly',
                    id:2
                }
            ];
        },function(response){
            alert('No predefined data are set for industires, company and products');
        });

        var original = angular.copy($scope.leadproj);
        $scope.postAddLeadForm = function (form) {
            

            if (form.$valid) {
                projectService.createProject($scope.leadproj,function(response){
                    if (response.data == 'success'){
                        alert('Project created succesfully');
                        $scope.leadproj = angular.copy(original);
                        $scope.addLead.$setPristine();
                        $scope.addLead.$setValidity();
                        $scope.addLead.$setUntouched();
                        //push data to table with scope.leadproj.pushto table :)
                    }
                },function(response){
                    var error = response.data;
                    alert('There was problem creating project');
                });
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
            $scope.leadproj.companyID = $scope.default;
            $scope.addLead.addCompanyName.$setUntouched();
            $scope.addLead.companyWebsite.$setUntouched();
            $scope.addLead.companyPhone.$setUntouched();
            $scope.addLead.companyAddress.$setUntouched();
            $scope.addLead.industry.$setUntouched();
            $scope.addLead.contactPerson.$setUntouched();
            $scope.addLead.contPerEmail.$setUntouched();
            $scope.addLead.contPerPhone.$setUntouched();
            $scope.addLead.contPerPos.$setUntouched();
            $scope.leadproj.addCompanyName='';
            $scope.leadproj.companyWebsite='';
            $scope.leadproj.companyPhone='';
            $scope.leadproj.companyAddress='';
            $scope.leadproj.industry='';
            $scope.leadproj.contactPerson='';
            $scope.leadproj.contPerEmail='';
            $scope.leadproj.contPerPhone='';
            $scope.leadproj.contPerPos='';
        };

        $scope.close = function () {
            $modalInstance.dismiss('cancel');
        };

    }]);

    salesVisionControllers.controller('forCloseDeal', ['$scope', '$modalInstance','projectService', function ($scope, $modalInstance,projectService) {
        projectService.loadProjectData(function(response){
            $scope.companies = response.data.company;
            $scope.industry = respons.data.industry;
            $scope.product = response.data.product;
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
        },function(response){
            alert('No predefined data are set for industires, company and products');
        });


        var original = angular.copy($scope.Dealproj);
        $scope.postAddDealForm = function (form) {
            

            if (form.$valid) {
                projectService.createProject($scope.Dealproj,function(response){
                    if (response.data == 'success'){
                        alert('Project created succesfully');
                        $scope.Dealproj = angular.copy(original);
                        $scope.addDeal.$setPristine();
                        $scope.addDeal.$setValidity();
                        $scope.addDeal.$setUntouched();
                        //push data to table
                    }
                },function(response){
                    var error = response.data;
                    alert('There was problem creating project');
                });
               

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
            $scope.Dealproj.companyID = $scope.default;
            $scope.addDeal.addCompanyName.$setUntouched();
            $scope.addDeal.companyWebsite.$setUntouched();
            $scope.addDeal.companyPhone.$setUntouched();
            $scope.addDeal.companyAddress.$setUntouched();
            $scope.addDeal.industry.$setUntouched();
            $scope.addDeal.contactPerson.$setUntouched();
            $scope.addDeal.contPerEmail.$setUntouched();
            $scope.addDeal.contPerPhone.$setUntouched();
            $scope.addDeal.contPerPos.$setUntouched();
            $scope.Dealproj.addCompanyName='';
            $scope.Dealproj.companyWebsite='';
            $scope.Dealproj.companyPhone='';
            $scope.Dealproj.companyAddress='';
            $scope.Dealproj.industry='';
            $scope.Dealproj.contactPerson='';
            $scope.Dealproj.contPerEmail='';
            $scope.Dealproj.contPerPhone='';
            $scope.Dealproj.contPerPos='';
        };

        $scope.close = function () {
            $modalInstance.dismiss('cancel');
        };

    }]);

    salesVisionControllers.controller('forCloseDelete', ['$scope', '$modalInstance','projectService', function ($scope, $modalInstance,projectService) {
        $scope.deleteHeader = "Delete a Project";
        $scope.deleteTitle = "Are you sure to delete this project?";
        var indexid = $modalInstance.id.id;
        projectService.deleteProject(indexid,function(response){
            if (response.status == 200){
                alert('Project has been deleted successfully');
            }
        },function(response){
            alert('There was an error deleting the selected project');
        });

        $scope.removeRow = function () {
            var currentid = $modalInstance.id;
            var index = $scope.rows.indexOf(currentid);
            $scope.rows.splice(index, 1);
        };

        $scope.close = function () {
            $modalInstance.dismiss('cancel');
        };


    }]);



    salesVisionControllers.controller('forClosePassword', ['$scope', '$modalInstance', function ($scope, $modalInstance) {

        var original = angular.copy($scope.user);
        $scope.postchpassformin = function (form) {

            if (form.$valid) {
                alert('can submit');
                $scope.user = angular.copy(original);
                $scope.changepassformin.$setPristine();
                $scope.changepassformin.$setValidity();
                $scope.changepassformin.$setUntouched();

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


    salesVisionControllers.controller('forCloseIndustry', ['$scope', '$modalInstance','settingService', function ($scope, $modalInstance,settingService) {
        settingService.showSettings(function(response){
            $scope.industryList = response.data.industry;
        },function(response){
            alert('Error in loading industries');
        });

        $scope.deleteSelected = function (index) {

            $scope.industryList.splice(index, 1);
        };

        $scope.close = function () {
            $modalInstance.dismiss('cancel');
        };

    }]);


    salesVisionControllers.controller('forCloseProduct', ['$scope', '$modalInstance','settingService', function ($scope, $modalInstance, settingService) {
        settingService.showSettings(function(response){
            $scope.productList = response.data.industry;
        },function(response){
            alert('Error in loading product');
        });
        $scope.productList = [{
                name: 'Healthcare'
            },
            {
                name: 'Retail'
            },
            {
                name: 'Education'
            },
            {
                name: 'Reseller'
            },
            {
                name: 'Automotive'
            },
            {
                name: 'Financial'
            },
            {
                name: 'Industrial'
            },
            {
                name: 'Telecommunication'
            }
        ];

        $scope.deleteSelected = function (index) {
            $scope.productList.splice(index, 1);
        };
        $scope.close = function () {
            $modalInstance.dismiss('cancel');
        };


    }]);

    salesVisionControllers.controller('forCloseEditlead', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
        $scope.leadproject = {
            "typeID": "",

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
                "name": "New sale"
            },
            {
                "id": "2",
                "name": "Renewal"
            }

        ];

        $scope.projectCat = {
            "catID": "0",

        };

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
            id:0
        }, {
            name: 'No',
            id:1
        }, {
            name: 'Possibly',
            id:2
        }
        ];



    $scope.selectedItemChanged=function(){

        if( $scope.projectCat.catID != 1){
            $scope.editLead.podate.$setUntouched();
            $scope.editLead.podate.$setValidity();
            $scope.editLead.podate.$setPristine();
            $scope.editLead.ponumber.$setUntouched();
            $scope.editLead.ponumber.$setValidity();
            $scope.editLead.ponumber.$setPristine();
            $scope.editLeadProj.ponumber='';
            $scope.editLeadProj.podate='';
            }

        if( $scope.projectCat.catID != 0){
                $scope.editLead.tender.$setUntouched();
                $scope.editLead.tender.$setValidity();
                $scope.editLead.tender.$setPristine();
                $scope.editLead.statusID.$setUntouched();
                $scope.editLead.statusID.$setValidity();
                $scope.editLead.statusID.$setPristine();
                }

    if( $scope.projectCat.catID != 2){
                    $scope.editLead.salesPerson.$setUntouched();
                    $scope.editLead.salesPersonr.$setValidity();
                    $scope.editLead.salesPerson.$setPristine();
            
                    }
        

    };

    

        /*
    $scope.leadsalesPerson = $modalInstance.leadproject.pincharge;    
    $scope.lead.statusID = $modalInstance.leadproject.status;
    write if else for tender scope;

    **/
    var original = angular.copy($scope.editLeadProj);
    $scope.editLeadRow = function (form) {
        /**call to update database */
        if (form.$valid) {
            alert('can submit');
            $scope.editLeadProj = angular.copy(original);
            $scope.editLead.$setPristine();
            $scope.editLead.$setValidity();
            $scope.editLead.$setUntouched();

        }
        if (form.$invalid) {

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



salesVisionControllers.controller('forCloseEditdeal', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    //$scope.dealcomname = $modalInstance.dealproject.companyName; (example of how pass the data to edit fields)
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
    var original = angular.copy($scope.editDealProj);
    $scope.editDealRow = function (form) {
        /**call to update database */
        if (form.$valid) {
            alert('can submit');
            $scope.editDealProj = angular.copy(original);
            $scope.editDeal.$setPristine();
            $scope.editDeal.$setValidity();
            $scope.editDeal.$setUntouched();

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


salesVisionControllers.controller('forCloseEditlostcase', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
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

    var original = angular.copy($scope.editLostProj);
    $scope.editLostRow = function (form) {
        /**call to update database */
        if (form.$valid) {
            alert('can submit');
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

/** for now its not required
salesVisionControllers.controller('forCloseContact', ['$scope', '$modalInstance', function ($scope, $modalInstance) {


    $scope.companies = [
    {
        "id": "114",

        "name": "Company 1"
    },
    {
        "id": "126",

        "name": "Company 2"
    },
    {
        "id": "149",
        "name": "Company 3"
    }];

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);
*/

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

salesVisionControllers.controller('forCloseMultipledelete', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeaderrows = "Delete Projects";
    $scope.deleteMessage = "Are you sure to delete the selected projects?";

    $scope.removeSelectedRows = function () {
        var rows = $modalInstance.list;
        var numbers = $modalInstance.list.length;
        for (var i = 0; i < numbers; i++) {
            angular.forEach($scope.rows, function (value) {
                if (value.No == rows[i]) {
                    var index = $scope.rows.indexOf(value);
                    $scope.rows.splice(index, 1);
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
salesVisionControllers.controller('forCloseEditcont', ['$scope', '$modalInstance', function ($scope, $modalInstance) {


    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

salesVisionControllers.controller('forCloseDeletecont', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeader = "Delete a Contact";
    $scope.deleteTitle = "Are you sure to delete this contact?";
    $scope.removeRow = function () {
        var currentid = $modalInstance.contlist;
        var index = $scope.rows5.indexOf(currentid);
        $scope.rows5.splice(index, 1);
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

salesVisionControllers.controller('forCloseMultiplecontdelete', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeaderrows = "Delete Contacts";
    $scope.deleteMessage = "Are you sure to delete the selected contacts?";

    $scope.removeSelectedRows = function () {
        var rows = $modalInstance.list;
        var numbers = $modalInstance.list.length;
        for (var i = 0; i < numbers; i++) {
            angular.forEach($scope.rows5, function (value) {
                if (value.No == rows[i]) {
                    var index = $scope.rows5.indexOf(value);
                    $scope.rows5.splice(index, 1);
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
salesVisionControllers.controller('forCloseEditcomp', ['$scope', '$modalInstance', function ($scope, $modalInstance) {


    $scope.close = function () {
        $modalInstance.dismiss('cancel');
    };


}]);

salesVisionControllers.controller('forCloseDeletecomp', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeader = "Delete a Company";
    $scope.deleteTitle = "Deleting this company will delete all the related projects and contacts. Do you want to proceed?";
    $scope.removeRow = function () {
        var currentid = $modalInstance.comlist;
        var index = $scope.rows4.indexOf(currentid);
        $scope.rows4.splice(index, 1);
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


salesVisionControllers.controller('forCloseMultiplecompdelete', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
    $scope.deleteHeaderrows = "Delete Companies";
    $scope.deleteMessage = "Deleting these companies will delete all the related project and contacts. Do you want to proceed?";

    $scope.removeSelectedRows = function () {
        var rows = $modalInstance.list;
        var numbers = $modalInstance.list.length;
        for (var i = 0; i < numbers; i++) {
            angular.forEach($scope.rows4, function (value) {
                if (value.No == rows[i]) {
                    var index = $scope.rows4.indexOf(value);
                    $scope.rows4.splice(index, 1);
                }


            });
        }

    };

    $scope.close = function () {
        $modalInstance.dismiss('cancel');
        $scope.companytable.rows4= 0;
    };


}]);



/**company modal controllers */
salesVisionControllers.controller('forCloseEditpers', ['$scope', '$modalInstance', function ($scope, $modalInstance) {
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


