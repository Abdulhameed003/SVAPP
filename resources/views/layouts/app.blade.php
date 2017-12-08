<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SalesVision') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/others/bootstrap.min.css')}}" rel="stylesheet" type="text/css" > 
    <link href="{{asset('css/style1.css')}}" rel="stylesheet" type="text/css" >

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css" /> 

    <!-- Angular -->
    <link href="{{asset('css/angular-datepicker.css')}}" rel="stylesheet" type="text/css" >
    
    <!-- Scripts -->
    <script src="{{asset('js/app.js') }}"></script>
    <script src="{{asset('js/angular.min.js')}}"></script>
    <script src="{{asset('js/angular-datepicker.js')}}"></script>
    <script src="{{asset('js/ui-bootstrap-tpls-0.14.3.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="{{asset('js/SV1.js')}}"></script>
    <script src="{{asset('js/checklist-model.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>

    <!--<script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script> -->

</head>
<body ng-controller="mainCtrl">
   
    @include('inc/navbar')
    @include('pages/project')
   
    
    

    

    <!-- Modal pages scripts section -->
        <script type="text/javascript">
            var yourbuttons = document.getElementsByClassName('mainbutton');
            for (var i = yourbuttons.length - 1; i >= 0; i--) {
                var currentbtn;
                yourbuttons[i].onclick = function () {
                    if (currentbtn) {
                        currentbtn.classList.remove("active");
                    }
                    this.classList.add("active");
                    currentbtn = this;
                }

            };

            $(document).click(function () {
                $(".dropdown-menu").hide();
            });

            $(".dropdown-menu").click(function (e) {
                e.stopPropagation();
            });

            $(".hidedropdown1").click(function () {
                $("#contentdropdown").hide();
            });
            $(".hidedropdown2").click(function () {
                $("#columndropdown").hide();
            });

            $("#showcontentdropdown").click(function () {
                $("#contentdropdown").show();
                $("#columndropdown").hide();
            });


            $("#showcolumndropdown").click(function () {
                $("#columndropdown").show();
                $("#contentdropdown").hide();
            });
        </script>
        
        <!--not required for now
        <script type="text/ng-template" id="addcontact.html"> 
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>New Contact</h3>
                </div>
                <form id="addContact" name="addContact">
            
                    <div class="modal-body">
                        <h4> Pleas fill the form to add new contact.</h4>
                        <div class="SectionBox">
                            <div class="form-group spacinga">
                                <div class="form-inline">
                                <select class="forInput form-control" ng-model="item.companyID"  ng-options="company.id as company.name for company in companies">
                                    <option value="" default disabled selected>Select the Company</option>
                                </select>
                                <input class="forInput form-control" type="text" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group">
                                <div class="form-inline">
                                <input class="forInput form-control" type="text" placeholder="Email">
                                <input class="forInput form-control" type="text" placeholder="Phone">
                            </div>
                        </div>
                            <div >
                                <input class="forInput form-control" type="text" placeholder="Position">
                            </div>
            
                        </div>
                    </div>
                    <div class="modal-footer" style="height:70px;">
                        <button type="submit" ng-click=close() class="button modalsubmit">Submit</button>
                    </div>
                </form>
                <a href="#" ng-click=close() style=" position:absolute;top:10px;left:573px;">
                    <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                </a>
            </div>
        </script>
        !-->

        <script type="text/ng-template" id="addsalesperson.html">
            <div class="modal-content">
            <div class="modal-header"  style="height:40px;">
                <h3>New sales person</h3>
            </div>
            <form id="addSalespersonform" name="addSalespersonform">
                <div class="modal-body">
                        <h4> Please fill in the form to add new sales person.</h4>
                <div class="SectionBox">   
                        <div class="form-group spacinga">
                        <div class="form-inline">
                        <input class="forInput form-control" type="text" placeholder="Name">
                        <input class="forInput form-control" type="text" placeholder="Id">
                    </div>
                </div>
                <div class="form-group">
                        <div class="form-inline">
                        <input class="forInput form-control" type="text" placeholder="Email">
                        <input class="forInput form-control" type="text" placeholder="Phone">
                    </div>
                </div>
                <div class="form-group">
                        <div class="form-inline">
                        <input class="forInput form-control" type="text" placeholder="Position">
                        <input class="forInput form-control" type="password" placeholder="Password">
                    </div>
                </div>
                    <div style="margin-left:270px;">
                        <input class="forInput form-control" type="password" placeholder="Confirm Password" >
                    </div>
                </div>
                </div>
                <div class="modal-footer" style="height:70px;">
                    <button type="submit" ng-click=close() class="button modalsubmit">Submit</button>
                </div>
            </form>
            <a href="#" ng-click=close() style=" position:absolute;top:10px;left:573px;">
                <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
            </a>
            </div>
        </script>

        <script type="text/ng-template" id="changepasswordmodal.html">  
            <div class="modal-content">
            <div class="modal-header" style="height:40px;">
                <h3>Change your Password</h3>
            </div>
            <form class="form-group">
                <div class="modal-body">
                        <div class="spacing">
                                <input type="password" ng-model="pass" class="forInput form-control" placeholder="Old Password" style="position:relative; left:10px;width:250px;">
                            </div>
                    <div class="spacing">
                        <input type="password" ng-model="pass" class="forInput form-control" placeholder="New Password" style="position:relative; left:10px;width:250px;">
                    </div>
                    <div class="spacing">
                        <input type="password" ng-model="confpass" class="forInput form-control" placeholder="Confirm Password" style="position:relative;left:10px;width:250px;">
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="submit" ng-click=close() class="button modalsubmit1">Submit</button>
                </div>
            </form>
            <a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
            <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
            </a>
            </div>
        </script>

        <script type="text/ng-template" id="delete.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                        <h3>@{{deleteHeader}}</h3>
                </div>
                <div class="modal-body" style="height:80px;border-radius:10px 10px 10px 10px;">
                        <h4> @{{deleteTitle}}</h4>
                </div>
                <div class="modal-footer">
                        <button type="submit" ng-click="close(); removeRow()" class="button deletemodalsubmit">Yes</button>
                </div>
                <a href="#" ng-click=close() style="position:absolute;top:10px;left:273px;">
                        <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                </a>

            </div>
        </script>

        <script type="text/ng-template" id="editcompany.html">
        
            <div class="modal-content">
            <div class="modal-header" style="height:40px;">
                <h3>Edit company</h3>
            </div>
            <form id="addLead" name="addLead" class="form-group">
                <div class="modal-body" style="overflow-y: auto; max-height:400px;">

                    <div class="spacing">
                        <input class="forInput form-control" type="text" placeholder="Company name" ng-model="editcomname">
                    </div>
                    <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Website" ng-model="website">
                        </div>
                        <div class="spacing">
                                <input class="forInput form-control" type="text" placeholder="Phone" ng-model="officephone">
                            </div>
            
                    <div class="spacing">
                        <select class="forInput form-control">
                            <option value="" default disabled selected>Select the industry</option>
                        </select>
                    </div>

                    <div class="spacing">
                        <textarea class="forInput form-control" wrap="soft" rows="5" type="text" size="255" placeholder="Address" ng-model="address" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" ng-click="close()" class="button modalsubmit">Submit</button>
                </div>

                <a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
                    <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                </a>


            </form>


            </div>

        </script>

        <script type="text/ng-template" id="editcontact.html">
                <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>Edit Contact</h3>
                </div>
                <form id="addLead" name="addLead" class="form-group">
                    <div class="modal-body" style="overflow-y: auto; max-height:400px;">
                        <select class="forInput form-control" ng-model="item.companyID"  ng-options="company.id as company.name for company in companies"
                        >
                            <option value="" default disabled selected>Select the company</option>
            
                        </select>
                        <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Name" ng-model="name">
                        </div>
                        <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Phone" ng-model="phone">
                        </div>
                        <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Email" ng-model="email">
                        </div>
                        <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Position" ng-model="position">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" ng-click="close()" class="button modalsubmit">Submit</button>
                    </div>
            
                    <a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
                        <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                    </a>
            
            
                </form>
            
            
            </div>
        </script>

        <script type="text/ng-template" id="editdeal.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>Edit Deal</h3>
                </div>
                <form id="editdeal" name="editDeal" class="form-group">
                    <div class="modal-body" style="overflow-y: auto; max-height:450px;">
                        <div class="form-inline spacingedit">
                        <div class="form-group">
                        <div>    
                        <label class="convertToblack">Company Name:</label>
                        </div>
                        <select class="forInput form-control" ng-model="item.companyID"  ng-options="company.id as company.name for company in companies"
                        ng-disabled="addcompany">
                        <option value="" default disabled selected>Select the Company</option>
                        </select>

                    </div>
                        <div class="form-group">
                                <div>    
                                        <label class="convertToblack">Person in Charge:</label>
                                        </div>
                            <select class="forInput form-control" ng-model="dealsalesPerson">
                                <option value="" default disabled selected>Select the Person in Charge</option>
        
                            </select>
                        </div>
                    </div>

                    <div class="form-inline spacingedit">
                        <div class="form-group">
                                <div>    
                                        <label class="convertToblack">Project Type:</label>
                                        </div>
                            <select class="forInput form-control" ng-model="leadproject.typeID"  ng-options="type.id as type.name for type in types">
                                    <option value="" default disabled selected>Select the Type</option>
                            </select>
                        </div>
                        <div class="form-group">
                                <div>    
                                        <label class="convertToblack">Product:</label>
                                        </div>
                            <select class="forInput form-control">
                                <option value="" default disabled selected>Select the Product</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-inline spacingedit">
                        <div class=" form-group">
                                <div>    
                                        <label class="convertToblack">Value:</label>
                                        </div>
                            <input class="forInput form-control" type="text" placeholder="Value" ng-model="dealValue">
                        </div>
                        <div class="form-group">
                                <div>    
                                        <label class="convertToblack">Sales Stage:</label>
                                        </div>
                            <input class="forInput form-control" type="text" placeholder="Sales Stage in Percentage" ng-model="dealsalesstage">
                        </div>
                    </div>

                    <div class="spacingedit" id="sub-left">
                        <div class="form-group">
                                <div>    
                                        <label class="convertToblack">Remarks:</label>
                                        </div>
                                <textarea class="forInput form-control" wrap="soft" rows="5"  type="text" size="255" placeholder="Remarks" ng-model="dealRemarks" />
                            </div>
                        </div>
                        
                        <div class="spacingedit"  id="sub-rightedit">  
                        <div class="form-group">
                                <div>    
                                        <label class="convertToblack">PO-Number:</label>
                                        </div>
                            <input class="forInput form-control" id="ponumber" type="text" placeholder="PO-Number" ng-model="POnum">
                        </div>
                    </div>

                    <div class="spacing"  id="sub-rightedit">  
                        <div class="form-group"> 
                                <div>    
                                        <label class="convertToblack">PO-Date:</label>
                                        </div>
                        <div class="datepicker modaldate " date-format="dd/MM/yyyy">
                            <input class="forInput modaldatepicke form-control" ng-model="POdate" type="text" placeholder="PO-Date">
                            <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                            </input>
                        </div>
                    </div>
                </div>
                <div class="clear-both"></div>

                <div   id="sub-left">  
                        <div class="form-group"> 
                                <div>    
                                        <label class="convertToblack">Start Date:</label>
                                        </div>
                        <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                            <input class="forInput modaldatepicker form-control" ng-model="dealstartdate" type="text" placeholder="Start Date">
                            <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                            </input>
                        </div>
                    </div>
                </div>
                <div  id="sub-rightedit">  
                        <div class="form-group"> 
                                <div>    
                                        <label class="convertToblack">End Date:</label>
                                        </div>

                        <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                            <input class="forInput modaldatepicker form-control" ng-model="dealenddate" type="text" placeholder="End Date">
                            <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                            </input>
                        </div>
                    </div>
                </div>
                <div class="clear-both"></div>
                    </div>

        
                    <div class="modal-footer">
                        <button type="submit" ng-click="close()" class="button modalsubmit">Submit</button>
                    </div>
        
                    <a href="#" ng-click="close()" style=" position:absolute;top:10px; left:573px;">
                        <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                    </a>
                </form>
        
        
        
            </div>
        
        </script>

        <script type="text/ng-template" id="dealproject.html">
            <div class="modal-content">

                <div class="modal-header" style="height:40px;">
                    <h3>New Deal</h3>
                </div>

                <form id="addDeal" name="addDeal" class="form-group">
                    <div class="modal-body" style="overflow-y: auto; max-height:450px;">
                        <h4> Please fill in the form to add new deal.</h4>
                        <div class="SectionBox">
                            <h5>Company and contact:</h5>
                            <div>
                                <select class="forInput form-control form-group" id="companyselect" ng-model="item.companyID"  ng-options="company.id as company.name for company in companies"
                                    ng-disabled="addcompany">
                                    <option value="" default disabled selected>Select the Company</option>
                                </select>
                                <a href="#" id="addIcon">
                                    <span id="addIcon" class="glyphicon glyphicon-plus-sign" ng-init="showAdd=false, " ng-click="showAdd=!showAdd; addcompany=!addcompany; resetSelect()"></span>
                                </a>
                            </div>

                            <div ng-show="showAdd">
                                <div class="form-group">
                                    <div class="form-inline">
                                        <input class="forInput form-control" type="text" ng-model="addCompanyName" placeholder="Company Name">
                                        <input class="forInput form-control" type="text" placeholder=" Company website">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-inline">
                                        <input class="forInput form-control" type="text" placeholder="Company Office Number">
                                        <input class="forInput form-control" type="text" placeholder="Company Address">
                                    </div>
                                </div>

                                <div class="form-group">
                                        <div class="form-inline">
                                            <select class="forInput form-control" ng-model="industry">
                                                <option value="" default disabled selected>Select the Industry</option>
                                            </select>
                                            <input class="forInput form-control" type="text" placeholder="Contact Person Name">
                                        </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-inline">
                                        <input class="forInput form-control" type="text" placeholder=" Contact Person Email">
                                        <input class="forInput form-control" type="text" placeholder="Contact Person Phone">
                                    </div>
                                </div>

                                <div>
                                    <input class="forInput form-control" type="text" placeholder="Contact Person Position">
                                </div>
                            </div>
                        </div>

                        <div class="SectionBox">
                            <h5>Deal Information:</h5>
                            <div class="form-group">
                                <div class="form-inline">
                                    <select class="forInput form-control" ng-model="salesPerson">
                                        <option value="" default disabled selected>Select the Person in Charge</option>
                                    </select>
                                    <select class="forInput form-control" ng-model="project.typeID"  ng-options="type.id as type.name for type in types">
                                            <option value="" default disabled selected>Select the Type</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    <select class="forInput form-control">
                                        <option value="" default disabled selected>Select the Product</option>
                                    </select>
                                    <input class="forInput form-control" type="text" placeholder="Value">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    <input class="forInput form-control" type="text" placeholder="Sales Stage in Percentage">
                                    <input class="forInput form-control" id="ponumber" type="text" placeholder="PO-Number">
                                </div>
                            </div>
                            <div id="sub-left">
                                    <textarea class="forInput form-control" wrap="soft" rows="6"  type="text" size="255" placeholder="Remarks" /> 
                            </div>
                            <div id="sub-right">
                                <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                                    <input class="forInput modaldatepicker form-control form-group" ng-model="POdate" type="text" placeholder="PO-Date">
                                    <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                                    </input>
                                </div>
                            </div>

                            <div id="sub-right">
                                <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                                    <input class="forInput modaldatepicker form-control form-group" ng-model="leadstartdate" type="text" placeholder="Start Date">
                                    <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                                    </input>
                                </div>
                            </div>
                            
                            <div id="sub-right">
                                <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                                    <input class="forInput modaldatepicker form-control form-group" ng-model="leadenddate" type="text" placeholder="End Date">
                                    <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                                    </input>
                                </div>
                            </div>
                            
                
                            <div class="clear-both"></div> 
        
                        </div>
                    </div>
                
                    <div class="modal-footer">
                        <button type="submit" ng-click=close() class="button modalsubmit">Submit</button>
                    </div>

                    <a href="#" ng-click=close() style=" position:absolute;top:10px;left:573px;">
                        <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                    </a>
                </form>

            </div>
        </script>


        <script type="text/ng-template" id="editindustry.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>Edit Industry List</h3>
                </div>
                <form class="form-group">
                    <div class="modal-body" style="overflow-y: auto; max-height:400px;min-height:400px;">
                        <div>
                            <input class="forInput form-control " id="industrytxf" type="text" placeholder="Industry Name">
                            <a href="#" id="addIcon">
                                <span id="addIcon" class="glyphicon glyphicon-plus-sign"></span>
                            </a>
                        </div>
                        <div ng-repeat="industry in industryList" class="spacing">
                            <div style="background-color:rgb(227, 227, 228);" class="listtext">
                                @{{industry.name}}
                                <a href="#" ng-click="deleteSelected($index)">
                                    <span class="glyphicon glyphicon-remove" style="color:#D32F2F;font-size:13px;float:right;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="button modalsubmit1" ng-click="close()">Submit</button>
                    </div>
                </form>
            
            
                <a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
                    <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                </a>
            </div>
        </script>

        <script type="text/ng-template" id="editlead.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>Edit lead</h3>
                </div>
                <form id="editlead" name="editlead" class="form-group">
                <div class="modal-body" style="overflow-y: auto; max-height:400px;">
                        
                <div class="form-inline spacingedit"> 
                <div class="form-group"> 
                        <div>
                            <lable class="converToblack">Company Name:</label>
                        </div>
                        <select class="forInput form-control" ng-model="item.companyID"  ng-options="company.id as company.name for company in companies">
                        <option value="" default disabled selected>Select the Company</option>
                    </select>
                </div>
                <div class="form-group"> 
                        <div>
                            <lable class="converToblack">Project Type:</label>
                        </div>
                    <select class="forInput form-control" ng-model="leadproject.typeID"  ng-options="type.id as type.name for type in types">
                            <option value="" default disabled selected>Select the Type of Project</option>
                    </select>
                </div>
                </div>
                <div class="form-inline spacingedit"> 
                        <div class="form-group"> 
                                <div>
                                    <lable class="converToblack">Product:</label>
                                    </div>
                        <select class="forInput form-control">
                            <option value="" default disabled selected>Select the Product</option>
                        </select>
                        </div>
            
                        <div class="form-group"> 
                        <div>
                            <lable class="converToblack">Value:</label>
                            </div>
                        <input class="forInput form-control" type="text" placeholder="Value" ng-model="leadValue">
                        </div>
                        </div>

                <div class="form-inline spacingedit"> 
                        <div class="form-group"> 
                                        <div>
                                            <lable class="converToblack">Sales Stage:</label>
                                            </div>
                                    <input class="forInput form-control" type="text" placeholder="Sales Stage in Percentage" ng-model="leadStage">
                                </div>
                                <div class="form-group">
                                        <div>
                                                <lable class="converToblack">Project Category:</label>
                                                </div>
                                        <select class="forInput form-control" id="ponumber" ng-model="projectCat.catID" ng-options="cat.id as cat.name for cat in cats" >
                                                <option value="" default disabled selected>Select the Category</option>
                                        </select>
                                    </div>
                </div>

                <div class="form-inline spacingedit"> 
                        <div class="form-group"> 
                            <div>
                                <lable class="converToblack">Start Date:</label>
                            </div>              
                        <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                            <input class="forInput form-control modaldatepicker" id="startdate" ng-model="leadstartdate" type="text" placeholder="Start Date">
                            <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                            </input>
                        </div>
                    </div>
                    <div class="form-group"> 
                            <div>
                            <lable class="converToblack">End Date:</label>
                            </div>  
                        <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                            <input class="forInput form-control modaldatepicker" ng-model="leadenddate" type="text" placeholder="End Date">
                            <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                            </input>
                        </div>
                    </div>
                </div>

                <div ng-show="projectCat.catID=='1'">
                    <div class="form-inline spacingedit"> 
                        <div class="form-group"> 
                            <div>
                                <lable class="converToblack">PO-Number:</label>
                            </div>
                            <div>
                                <input class="forInput form-control"  id="ponumber" type="text" placeholder="PO-Number" ng-model="POnum">
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div>
                                <lable class="converToblack">PO-Date:</label>
                            </div>
                            <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                                <input class="forInput form-control modaldatepicker" ng-model="POdate" type="text" placeholder="PO-date">
                                <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                                </input>
                            </div>
                        </div>
                    </div>
                </div>


                <div ng-hide="projectCat.catID !='0'">
                        <div class="form-inline spacingedit"> 
                                <div class="form-group"> 
                                                    <div>
                                                            <lable class="converToblack">Status:</label>
                                                    </div>
                                                <select class="forInput form-control" ng-model="lead.statusID"  ng-options="status.id as status.name for status in statuses">
                                                        <option value="" default disabled selected>Select the status</option>
                                                </select>
                                </div>
                                
                                <div class="form-group"> 
                                                <div>
                                                <label class="convertToblack">Tender:</label>
                                                </div>
                                        <div  class="form-inline" style="margin-left:10px;">
                                                <input type="checkbox" class="checkbox-default" ng-model="tenderYes" ng-click="checkboxRule('tenderYes')" />
                                                <label class="convertToblack">Yes</label>
                            
                            
                                                <input type="checkbox" class="checkbox-default Dealcheckbox" ng-model="tenderNo" ng-click="checkboxRule('tenderNo')" />
                                                <label class="convertToblack">No</label>
                            
                                                <input type="checkbox" class="checkbox-default Dealcheckbox" ng-model="tenderPossibly" ng-click="checkboxRule('tenderPossibly')"
                                                />
                                                <label class="convertToblack">Possibly</label>
                                        </div >
                                </div>
                        </div>
                    </div>
                    <div id="sub-left"> 
                            <div class="spacingedit form-group"> 
                                <div>
                                    <lable class="convertToblack">Remarks:</label>
                                </div>
                                <textarea class="forInput form-control" wrap="soft" rows="5" type="text" size="255" placeholder="Remarks" ng-model="leadremarks" />
                            </div> 
                        </div>
                    
                        <div class="spacingedit" ng-hide="projectCat.catID =='2'">
                                <div id="sub-rightedit">
                                        <div class="form-group"> 
                                                <div>
                                                    <lable class="converToblack">Person in Charge:</label>
                                                </div>
                                        <select class="forInput form-control" ng-model="leadsalesPerson">
                                                <option value="" default disabled selected>Select the Person in Charge</option>
                    
                                        </select>
                                    </div>
                                </div>
                        </div>
            
            </div>
        
                    <div class="modal-footer">
                        <button type="submit" ng-click="close()" class="button modalsubmit">Submit</button>
                    </div>
        
                    <a href="#" ng-click="close()" style=" position:absolute;top:10px;left:573px;">
                        <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                    </a>
        
        
                </form>
        
        
            </div>
        
        </script>

        <script type="text/ng-template" id="editlostcase.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>Edit lost case</h3>
                </div>
                <form id="addLead" name="addLead" class="form-group">
                    <div class="modal-body" style="overflow-y: auto; max-height:400px;">
                        <select class="forInput form-control" ng-model="item.companyID"  ng-options="company.id as company.name for company in companies"
                        ng-disabled="addcompany">
                        <option value="" default disabled selected>Select the company</option>
                    </select>
        

                        <div class="spacing">
                            <select class="forInput form-control" ng-model="leadproject.typeID" ng-options="type.id as type.name for type in types">
                                        <option value="" default disabled selected>Select the type of project</option> 
                            </select>
                        </div>
                        <div class="spacing">
                            <select class="forInput form-control">
                                <option value="" default disabled selected>Select the product</option>
                            </select>
                        </div>
                        <div class="spacing">
                            <input class="forInput form-control " type="text" placeholder="Value" ng-model="leadValue">
                        </div>

                        <div class="spacing">
                            <textarea class="forInput form-control" wrap="soft" id="ponumber" rows="5" type="text" size="255" placeholder="Remarks" ng-model="leadremarks" />
                        </div>


                        <div class="datepicker modaldate" date-format="dd/MM/yyyy" id="ponumber" >
                            <input class="forInput form-control modaldatepicker"  ng-model="leadstartdate" type="text" placeholder="Start date">
                            <i class="fa fa-calendar fafaPosititionondatepicker2"></i>
                            </input>
                        </div>
                        <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                            <input class="forInput form-control modaldatepicker" ng-model="leadenddate" type="text" placeholder="End date">
                            <i class="fa fa-calendar fafaPosititionondatepicker2"></i>
                            </input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" ng-click="close()" class="button modalsubmit">Submit</button>
                    </div>
        
                    <a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
                        <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                    </a>
        
        
                </form>
        
        
            </div>
        </script>

        <script type="text/ng-template" id="editproduct.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>Edit Product List</h3>
                </div>
                <form class="form-group">
                    <div class="modal-body" style="overflow-y: auto; max-height:400px;min-height:400px;">
                        <div>
                            <input class="forInput form-control" id="industrytxf" type="text" placeholder="Product Name">
                            <a href="#" id="addIcon">
                                <span id="addIcon" class="glyphicon glyphicon-plus-sign"></span>
                            </a>
                        </div>
                        <div ng-repeat="product in productList" class="spacing">
                            <div style="background-color:rgb(227, 227, 228);" class="listtext">
                                @{{product.name}}
                                <a href="#" ng-click="deleteSelected($index)">
                                    <span class="glyphicon glyphicon-remove" style="color:#D32F2F;font-size:13px;float:right;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="button modalsubmit1" ng-click="close()">Submit</button>
                    </div>
                </form>
            
            
                <a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
                    <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                </a>
            </div>
        </script>

        <script type="text/ng-template" id="editsalesperson.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>Edit sales person</h3>
                </div>
                <form id="addLead" name="addLead" class="form-group">
                    <div class="modal-body" style="overflow-y: auto; max-height:400px;">
                        <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Name" ng-model="name">
                        </div>
                        <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Phone" ng-model="phone">
                        </div>
                        <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Email" ng-model="email">
                        </div>
                        <div class="spacing">
                            <input class="forInput form-control" type="text" placeholder="Position" ng-model="position">
                        </div>
            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" ng-click="close()" class="button modalsubmit">Submit</button>
                    </div>
            
                    <a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
                        <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                    </a>
            
            
                </form>
            
            
            </div>
        
        </script>

        <script type="text/ng-template" id="leadproject.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>New Lead</h3>
                </div>

                <form id="addLead" name="addLead" class="form-group">
                    <div class="modal-body" style="overflow-y: auto; max-height:450px;">
                        <h4> Please fill in the form to add new lead.</h4>
                        <div class="SectionBox">
                            <h5>Company and Contact:</h5>
                            <div>
                                <select  class="forInput form-control form-group" id="companyselect" ng-model="item.companyID"  ng-options="company.id as company.name for company in companies"
                                    ng-disabled="addcompany">
                                    <option value="" default disabled selected>Select the Company</option>
                                </select>
                                <a href="#" id="addIcon">
                                    <span id="addIcon" class="glyphicon glyphicon-plus-sign" ng-init="showAdd=false, " ng-click="showAdd=!showAdd; addcompany=!addcompany; resetSelect()"></span>
                                </a>
                            </div>
                            <div ng-show="showAdd">
                                <div class="form-group">
                                <div class="form-inline">
                                    <input class="forInput form-control" type="text" ng-model="addCompanyName" placeholder="Company name">
                            
                                    <input class="forInput form-control" type="text" placeholder="Company Website">
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="form-inline">
                                    <input class="forInput form-control" type="text" placeholder="Company Office Number">
                            
                    
                                    <input class="forInput form-control" type="text" placeholder="Company Address">
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="form-inline">
                                    <select class="forInput form-control" ng-model="industry">
                                        <option value="" default disabled selected>Select the Industry</option>
        
                                    </select>
                    
                                    <input class="forInput form-control" type="text" placeholder="Contact Person Name">
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="form-inline">
                                    <input class="forInput form-control" type="text" placeholder="Contact Person Email">
                        
                                    <input class="forInput form-control" type="text" placeholder="Contact Person Phone">
                                </div>
                            </div>
                                <div>
                                    <input class="forInput form-control" type="text" placeholder="Contact Person Position">
                                </div>
                            </div>
                        </div>
                    
                        <div class="SectionBox">
                            <h5>Lead Information:</h5>
                            <div class="form-group">
                                    <div class="form-inline">
                                <select class="forInput form-control" ng-model="salesPerson">
                                    <option value="" default disabled selected>Select the Person in Charge</option>
                                </select>
        
                    
                                <select class="forInput form-control" ng-model="project.typeID"  ng-options="type.id as type.name for type in types">
                                        <option value="" default disabled selected>Select the Type of Project</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="form-inline">
                                <select class="forInput form-control">
                                    <option value="" default disabled selected>Select the Product</option>
                                </select>
                    
                                <input class="forInput form-control" type="text" placeholder="Value">
                            </div>
                        </div>
                    
                        <div class="form-group">
                                <div class="form-inline">
                                <input class="forInput form-control" type="text" placeholder="Sales Stage in Percentage">
                        
                                <select class="forInput form-control" ng-model="lead.statusID"  ng-options="status.id as status.name for status in statuses">
                                        <option value="" default disabled selected>Select the Status</option>
                                </select>
                            </div>
                        </div>
                    <div id="sub-left">
                        <div class="datepicker modaldate" date-format="dd/MM/yyyy">
                                <input class=" form-group forInput form-control modaldatepicker" ng-model="leadstartdate" type="text" placeholder="Start Date">
                                <i class="fa fa-calendar fafaPosititionondatepicker"></i>
                                </input>
                    </div>
                        
                    </div>
                <div id="sub-right">
                        <div   class="datepicker modaldate" date-format="dd/MM/yyyy">
                        <input  class="forInput form-control modaldatepicker" ng-model="leadenddate" type="text" placeholder="End Date">
                    
                        </input>
                        </div>
                    </div>
                    <i class="fa fa-calendar fafaPosititionondatepickerend"></i>
                    <div class="clear-both"></div> 
                    <div class="form-inline">
                        <label class="convertToblack" style="padding-right:10px;">Tender:</label>
                                <input type="checkbox" class="checkbox-default" ng-model="tenderYes" ng-click="checkboxRule('tenderYes')" />
                                <label class="convertToblack">Yes</label>

                                <input type="checkbox" class="checkbox-default Dealcheckbox" ng-model="tenderNo" ng-click="checkboxRule('tenderNo')" />
                                <label class="convertToblack">No</label>

                                <input type="checkbox" class="checkbox-default Dealcheckbox" ng-model="tenderPossibly" ng-click="checkboxRule('tenderPossibly')"
                                />
                                <label class="convertToblack">Possibly</label>
                                            
                                <textarea  class="forInput form-control" wrap="soft" rows="5"  type="text" size="255" placeholder="Remarks" style="margin-left:17px;" />
                    </div>
                    
                        </div>
            
                    </div>
        
                    <div class="modal-footer">
                        <button type="submit" ng-click=close() class="button modalsubmit">Submit</button>
                    </div>
        
                    <a href="#" ng-click=close() style=" position:absolute;top:10px;left:573px;">
                        <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                    </a>
        
        
                </form>
            </div>
        </script>


        <script type="text/ng-template" id="multipledelete.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>@{{deleteHeaderrows}}</h3>
        
                </div>
                <div class="modal-body" style="height:100px;border-radius:10px 10px 10px 10px;">
                    <h4> @{{deleteMessage}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" ng-click="close(); removeSelectedRows()" class="button deletemodalsubmit">Yes</button>
                </div>
                <a href="#" ng-click=close() style="position:absolute;top:10px;left:273px;">
                    <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                </a>
        
            </div>
        </script>


        <script type="text/ng-template" id="multipledelete2.html">
            <div class="modal-content">
                <div class="modal-header" style="height:40px;">
                    <h3>@{{deleteHeaderrows}}</h3>
        
                </div>
                <div class="modal-body" style="height:100px;border-radius:10px 10px 10px 10px;">
                    <h4>@{{deleteErrorMessage}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" ng-click="close()" class="button deletemodalsubmit">Ok</button>
                </div>
                <a href="#" ng-click="close()" style="position:absolute;top:10px;left:273px;">
                    <span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
                </a>
            </div>
        </script>
    <!-- Modal pages scripts section end  -->

</body>
</html>
