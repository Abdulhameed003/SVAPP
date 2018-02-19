<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="app">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<base href="/">
	<title>{{ config('app.name', 'SalesVision') }}</title>

	<!-- Styles -->

	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('css/others/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/style2.css')}}" rel="stylesheet" type="text/css">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css" />

	<!-- Angular -->
	<link href="{{asset('css/angular-datepicker.css')}}" rel="stylesheet" type="text/css">

	<!-- Scripts -->

	<script src="{{asset('bower_components/angular/angular.min.js')}}"></script>
	<script src="{{asset('js/angular-datepicker.js')}}"></script>
	<script src="{{asset('js/ui-bootstrap-tpls-0.14.3.min.js')}}"></script>
	<script src="{{asset('js/checklist-model.js')}}"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular-messages.js"></script>
	<script src="{{asset('bower_components/angular-route/angular-route.min.js')}}"></script>
	<script src="{{asset('bower_components/angular-local-storage/dist/angular-local-storage.js')}}"></script>
	<script src="{{('bower_components/angular-route/angular-route.min.js')}}"></script>

	<script src="{{asset('js/angular-fusioncharts.min.js')}}"></script>
	<script src="{{asset('js/fusioncharts.charts.js')}}"></script>
	<script src="{{asset('js/fusioncharts.js')}}"></script>
	<script src="{{asset('js/fusioncharts.widgets.js')}}"></script>
	<script src="{{asset('js/fusioncharts.theme.fint.js')}}"></script>
	<script src="{{asset('js/SVservices.js')}}"></script>
	<script src="{{asset('js/SVcontroller.js')}}"></script>
	<script src="{{asset('js/SV1.js')}}"></script>
	<script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('js/bootstrap.js')}}"></script>
	<script src="{{asset('js/custom.js')}}"></script>
	<script src="{{asset('js/moment.js')}}"></script>
	<script src="{{asset('js/angular-moment.js')}}"></script>

	<style>
		body {
			background-size: cover;
			overflow-x: hidden;
		}
	</style>
</head>

<body ng-controller="{{Auth::guest() ? 'registerController' : 'mainCtrl'}}">

	@if(Auth::guest())
		 @yield('content') 
	@endif 
	
	@includeWhen(Auth::check(),'inc.navbar')
	<div class="ng-view"></div>




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
			<div class="modal-header" style="height:40px;">
				<h3>New sales person</h3>
			</div>
			<form id="addSalespersonform" name="addSalespersonform" novalidate>
				<div class="modal-body">
					<h4> Please fill in the form to add new sales person.</h4>
					<div class="SectionBox">
						<div class- "container">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group spacinga">
										<input class="forInput form-control" only-letters-input type="text" name="salespername" ng-model="Sperson.name" ng-class="{submitting: addSalespersonform.salespername.$error.required && addSalespersonform.salespername.$touched }"
										 placeholder="Name" required>
										<div class="errormainpage" ng-show="addSalespersonform.salespername.$error.required" ng-if="addSalespersonform.salespername.$touched">Can't leave this empty.</div>
									</div>
									<div class="form-group spacinga">
										<input class="forInput form-control" type="email" name="salesperemail" ng-model="Sperson.email" ng-class="{submitting: (addSalespersonform.salesperemail.$error.required ||addSalespersonform.salesperemail.$error.email) && addSalespersonform.salesperemail.$touched }"
										 placeholder="Email" required>
										<div ng-messages="addSalespersonform.salesperemail.$error" class="errormainpage">
											<div ng-message="email" ng-if="addSalespersonform.salesperemail.$touched">Wrong email format.</div>
											<div ng-message="required" ng-if="addSalespersonform.salesperemail.$touched">Can't leave this empty.</div>
										</div>
									</div>
									<div class=" form-group spacinga">
										<input class="forInput form-control" type="text" only-letters-input name="salesperpos" ng-model="Sperson.position" ng-class="{submitting: addSalespersonform.salesperpos.$error.required && addSalespersonform.salesperpos.$touched }"
										 placeholder="Position" required>
										<div class="errormainpage" ng-show="addSalespersonform.salesperpos.$error.required" ng-if="addSalespersonform.salesperpos.$touched">Can't leave this empty.</div>
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group spacinga">
										<input class="forInput form-control" type="text" name="salesperId" ng-model="Sperson.salesperson_id" ng-class="{submitting: addSalespersonform.salesperId.$error.required && addSalespersonform.salesperId.$touched }"
										 placeholder="ID" required>
										<div class="errormainpage" ng-show="addSalespersonform.salesperId.$error.required" ng-if="addSalespersonform.salesperId.$touched">Can't leave this empty.</div>
									</div>
									<div class="form-group spacinga" id="registerpassword">
										<input class="forInput form-control" type="text" name="salesperphone" ng-model="Sperson.phone_num" ng-class="{submitting: addSalespersonform.salesperphone.$error.required && addSalespersonform.salesperphone.$touched }"
										 restrict-to="[0-9]" placeholder="Phone" required popover="Example: 0172345464" popover-placement="bottom" popover-trigger="mouseenter">
										<div class="errormainpage" ng-show="addSalespersonform.salesperphone.$error.required" ng-if="addSalespersonform.salesperphone.$touched">Can't leave this empty.</div>
									</div>

									<div class="form-group spacinga" id="registerpassword">
										<input id="regpass" type="password" ng-class="{submitting: addSalespersonform.salesperpassword.$error.minlength || addSalespersonform.salesperpassword.$error.pattern || addSalespersonform.salesperpassword.$error.required && addSalespersonform.salesperpassword.$touched}"
										 name="salesperpassword" ng-model="Sperson.password" ng-minlength="8" ng-pattern="/(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z])/"
										 class="form-control forInput" placeholder="Password" required popover="Passwords must be at least 8 characters and contain one lower &amp; one uppercase letter, and one non-alpha character (a number or a symbol.)"
										 popover-placement="bottom" popover-trigger="mouseenter" />
										<div ng-messages="addSalespersonform.salesperpassword.$error" class="errormainpage">
											<div ng-message="minlength && pattern" ng-if="addSalespersonform.salesperpassword.$touched">Wrong password format.</div>
											<div ng-message="required" ng-if="addSalespersonform.salesperpassword.$touched">Can't leave this empty.</div>
										</div>
									</div>
									<div class="form-group spacinga">
										<input type="password" ng-class="{submitting: ((addSalespersonform.salesperpasswordconf.$error.required || addSalespersonform.salesperpasswordconf.$error.compareTo && Sperson.password)  && addSalespersonform.salesperpasswordconf.$touched )}"
										 name="salesperpasswordconf" ng-model="passconf" class="form-control forInput" placeholder="Confirm Password" compare-to="Sperson.password"
										 required>
										<div ng-messages="addSalespersonform.salesperpasswordconf.$error" class="errormainpage">
											<div ng-message="required" ng-if="addSalespersonform.salesperpasswordconf.$touched">Can't leave this empty.</div>
											<div ng-message="compareTo" ng-if="addSalespersonform.salesperpasswordconf.$touched">Passwords do not match! </div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer" style="height:70px;">
					<button type="submit" ng-click="postAddSalesPerson(addSalespersonform)" class="button modalsubmit">Submit</button>
				</div>
			</form>
			<a href="#" ng-click=close() style=" position:absolute;top:10px;left:573px;">
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

	<script type="text/ng-template" id="changepasswordmodal.html">
		<div class="modal-content">
			<div class="modal-header" style="height:40px;">
				<h3>Change your Password</h3>
			</div>
			<form id="chpassform" name="changepassformin" novalidate class="form-group">
				<div class="modal-body">

					<input type="hidden" name="id" user.id="{{Auth::id()}}">

					<div class="form-group spacinga">
						<input type="password" required name="useroldpass" ng-model="user.oldpassword" ng-class="{submitting: changepassformin.useroldpass.$error.required && changepassformin.useroldpass.$touched }"
						 class="forInput form-control" placeholder="Old Password">
						<div class="errormainpage">
							<div ng-show="changepassformin.useroldpass.$error.required" ng-if="changepassformin.useroldpass.$touched">Can't leave this empty.</div>
						</div>
					</div>

					<div class="form-group spacinga" id="registerpassword">
						<input id="regpass" type="password" ng-class="{submitting: changepassformin.userpassword.$error.minlength || changepassformin.userpassword.$error.pattern || changepassformin.userpassword.$error.required && changepassformin.userpassword.$touched}"
						 name="userpassword" ng-model="user.password" ng-minlength="8" ng-pattern="/(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z])/"
						 class="forInput form-control" placeholder="Password" aria-required="true" required popover="Passwords must be at least 8 characters and contain one lower &amp; one uppercase letter, and one non-alpha character (a number or a symbol.)"
						 popover-placement="bottom" popover-trigger="mouseenter" />
						<div ng-messages="changepassformin.userpassword.$error" class="errormainpage">
							<div ng-message="minlength && pattern" ng-if="changepassformin.userpassword.$touched">Wrong password format.</div>
							<div ng-message="required" ng-if="changepassformin.userpassword.$touched">Can't leave this empty.</div>
						</div>
					</div>


					<div class="form-group spacinga">
						<input type="password" ng-class="{submitting: ((changepassformin.userpasswordconf.$error.required || changepassformin.userpasswordconf.$error.compareTo && user.password)  && changepassformin.userpasswordconf.$touched )}"
						 name="userpasswordconf" ng-model="passconf" class="form-control forInput" placeholder="Confirm Password" compare-to="user.password"
						 required>
						<div ng-messages="changepassformin.userpasswordconf.$error" class="errormainpage">
							<div ng-message="required" ng-if="changepassformin.userpasswordconf.$touched">Can't leave this empty.</div>
							<div ng-message="compareTo" ng-if="changepassformin.userpasswordconf.$touched && user.password">Passwords do not match! </div>

						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" ng-click="postchpassformin(changepassformin)" class="button modalsubmit1">Submit</button>
				</div>
			</form>
			<a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
				<span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
			</a>
		</div>
	</script>

	<script type="text/ng-template" id="editcompany.html">

		<div class="modal-content">
			<div class="modal-header" style="height:40px;">
				<h3>Edit company</h3>
			</div>
			<form id="editcompany" name="editcompany" class="form-group" novalidate>
				<div class="modal-body" style="overflow-y: auto; max-height:450px;">

					<div class="form-group spacing">
						<div class="labelbottomspace">
							<lable class="convertToblack">Company Name:</label>
						</div>
						<input class="forInput form-control" type="text" placeholder="Company name" ng-model="editcom.company_name" name="companyName"
						 ng-class="{submitting:editcompany.companyName.$error.required && editcompany.companyName.$touched}" required>
						<div ng-messages="editcompany.companyName.$error" class="errormainpage">
							<div ng-message="required" ng-if="editcompany.companyName.$touched">Can't leave this empty.</div>
						</div>
					</div>
					<div class="form-group spacingedit">
						<div class="labelbottomspace">
							<lable class="convertToblack">Website:</label>
						</div>
						<input class="forInput form-control" type="text" ng-pattern="/^(((ht|f)tp(s?))\://)?(www.|[a-zA-Z].)[a-zA-Z0-9\-\.]+\.(com|edu|gov|mil|net|org|biz|info|name|museum|us|ca|uk)(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\;\?\'\\\+&amp;%\$#\=~_\-]+))*$/"
						 name="companyWebsite" ng-model="editcom.website" placeholder="Company Website" ng-class="{submitting:(editcompany.companyWebsite.$error.required || editcompany.companyWebsite.$error.pattern) && editcompany.companyWebsite.$touched}"
						 required>
						<div class="errormainpage" ng-messages="editcompany.companyWebsite.$error">
							<div ng-message="required" ng-if="editcompany.companyWebsite.$touched">Can't leave this empty.</div>
							<div ng-message="pattern" ng-if="editcompany.companyWebsite.$touched">Wrong website format.</div>
						</div>
					</div>
					<div class="form-group spacingedit" id="registerpassword">
						<div class="labelbottomspace">
							<lable class="convertToblack">Phone:</label>
						</div>
						<input class="forInput form-control" type="text" name="companyPhone" ng-model="editcom.office_num" ng-maxlength="10" placeholder="Company Office Phone Number"
						 ng-class="{submitting:((editcompany.companyPhone.$error.required || editcompany.companyPhone.$error.maxlength) && editcompany.companyPhone.$touched)}"
						 required restrict-to="[0-9]" popover="Example: 037463325" popover-placement="bottom" popover-trigger="mouseenter">
						<div ng-messages="editcompany.companyPhone.$error" class="errormainpage">
							<div ng-message="required" ng-if="editcompany.companyPhone.$touched">Can't leave this empty.</div>
							<div ng-message="maxlength" ng-if="editcompany.companyPhone.$touched">Maximum length is 10 numbers.</div>
						</div>
					</div>

					<div class="form-group spacingedit">
						<div class="labelbottomspace">
							<lable class="convertToblack">Industry:</label>
						</div>
						<select class="forInput form-control" name="industry" ng-model="editcom.industry_id" ng-options="industry.id as industry.industry for industry in industryList"
						 ng-class="{submitting:editcompany.industry.$error.required && editcompany.industry.$touched}" required>
							<option value="" default disabled selected>Select the Industry</option>
						</select>
						<div class="errormainpage">
							<div ng-show="editcompany.industry.$error.required" ng-if="editcompany.industry.$touched">Can't leave this empty.</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" ng-click="postEditCompany(editcompany)" class="button modalsubmit1">Submit</button>
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
			<form id="editContact" name="editContact" class="form-group" novalidate>
				<div class="modal-body" style="overflow-y: auto; max-height:450px;">
					<div class="form-group spacing">
						<div class="labelbottomspace">
							<lable class="convertToblack">Company Name:</label>
						</div>
						<input type="text" class="forInput form-control" ng-model="editcont.company_name" ng-disabled="true" />
					</div>

					<div class="form-group">
						<div class="labelbottomspace">
							<lable class="convertToblack">Contact Name:</label>
						</div>
						<input class="forInput form-control" only-letters-input type="text" name="contactPerson" ng-model="editcont.contact_name"
						 placeholder="Contact Person Name" ng-class="{submitting:editContact.contactPerson.$error.required && editContact.contactPerson.$touched}"
						 required>
						<div class="errormainpage">
							<div ng-show="editContact.contactPerson.$error.required" ng-if="editContact.contactPerson.$touched">Can't leave this empty.</div>
						</div>

					</div>
					<div class="form-group spacingedit" id="registerpassword">
						<div class="labelbottomspace">
							<lable class="convertToblack">Phone:</label>
						</div>
						<input class="forInput form-control" type="text" name="contPerPhone" ng-maxlength="15" ng-model="editcont.contact_number"
						 placeholder="Contact Person Phone Number" ng-class="{submitting:((editContact.contPerPhone.$error.required || editContact.contPerPhone.$error.maxlength) && editContact.contPerPhone.$touched)}"
						 required popover="Example: 0172345464" popover-placement="bottom" popover-trigger="mouseenter" restrict-to="[0-9]">
						<div ng-messages="editContact.contPerPhone.$error" class="errormainpage">
							<div ng-message="required" ng-if="editContact.contPerPhone.$touched">Can't leave this empty.</div>
							<div ng-message="maxlength" ng-if="editContact.contPerPhone.$touched">Maximum length is 15 numbers.</div>
						</div>
					</div>
					<div class="form-group spacingedit">
						<div class="labelbottomspace">
							<lable class="convertToblack">Email:</label>
						</div>
						<input class="forInput form-control" type="email" name="contPerEmail" ng-model="editcont.email" placeholder="Contact Person Email"
						 ng-class="{submitting: ((editContact.contPerEmail.$error.email || editContact.contPerEmail.$error.required) && editContact.contPerEmail.$touched)}"
						 required>
						<div ng-messages="editContact.contPerEmail.$error" class="errormainpage">
							<div ng-message="email" ng-if="editContact.contPerEmail.$touched">Wrong email format.</div>
							<div ng-message="required" ng-if="editContact.contPerEmail.$touched">Can't leave this empty.</div>
						</div>
					</div>
					<div class="form-group spacingedit">
						<div class="labelbottomspace">
							<lable class="convertToblack">Position:</label>
						</div>
						<input class="forInput form-control" type="text" only-letters-input name="contPerPos" ng-model="editcont.designation" placeholder="Contact Person Position"
						 ng-class="{submitting:editContact.contPerPos.$error.required && editContact.contPerPos.$touched}" required>
						<div class="errormainpage">
							<div ng-show="editContact.contPerPos.$error.required" ng-if="editContact.contPerPos.$touched">Can't leave this empty.</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" ng-click="postEditContact(editContact)" class="button modalsubmit1">Submit</button>
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
			<form id="editdeal" name="editDeal" class="form-group" novalidate>
				<div class="modal-body" style="overflow-y: auto; max-height:450px;">
					<div class="form-inline spacingedit">
						<div class="form-group">
							<div>
								<label class="convertToblack">Company Name:</label>
							</div>
							<input type="text" class="forInput form-control" ng-model="editDealProj.company_name" ng-disabled="true">
						</div>
						<div class="form-group">
							<div>
								<label class="convertToblack">Person in Charge:</label>
							</div>
							<select class="forInput form-control form-group" name="salesPerson" ng-model="editDealProj.salesperson_id" ng-options="salesperson.salesperson_id as salesperson.name for salesperson in salespersonList " ng-class="{submitting:editDeal.salesPerson.$error.required && editDeal.salesPerson.$touched}"
							 required>
								<option value="" default disabled selected>Select the Person in Charge</option>
							</select>
							<div ng-messages="editDeal.salesPerson.$error" class="errormainpage">
								<div ng-message="required" ng-if="editDeal.salesPerson.$touched">Can't leave this empty.</div>
							</div>
						</div>
					</div>

					<div class="form-inline spacinga">
						<div class="form-group">
							<div>
								<label class="convertToblack">Project Type:</label>
							</div>
							<select class="forInput form-control" ng-model="editDealProj.project_type" name="typeID" ng-options="type.name as type.name for type in types"
							 ng-class="{submitting:editDeal.typeID.$error.required && editDeal.typeID.$touched}" required>
								<option value="" default disabled selected>Select the Type of Project</option>
							</select>
							<div class="errormainpage">
								<div ng-show="editDeal.typeID.$error.required" ng-if="editDeal.typeID.$touched">Can't leave this empty.</div>
							</div>
						</div>

						<div class="form-group">
							<div>
								<label class="convertToblack">Product:</label>
							</div>
							<select class="forInput form-control" ng-model="editDealProj.product" ng-options="product.id as product.product_name for product in productList"
							 name="product" ng-class="{submitting:editDeal.product.$error.required && editDeal.product.$touched}" required>
								<option value="" default disabled selected>Select the Product</option>
							</select>
							<div class="errormainpage">
								<div ng-show="editDeal.product.$error.required" ng-if="editDeal.product.$touched">Can't leave this empty.</div>
							</div>
						</div>
					</div>

					<div class="form-inline spacinga">
						<div class=" form-group">
							<div>
								<label class="convertToblack">Value:</label>
							</div>
							<input class="forInput form-control" type="text" ng-model="editDealProj.value" placeholder="Value" restrict-to="[0-9]" name="value"
							 ng-class="{submitting:editDeal.value.$error.required && editDeal.value.$touched}" required>
							<div class="errormainpage">
								<div ng-show="editDeal.value.$error.required" ng-if="editDeal.value.$touched">Can't leave this empty.</div>
							</div>
						</div>
						<div class="form-group">
							<div>
								<label class="convertToblack">Sales Stage:</label>
							</div>
							<input class="forInput form-control" type="text" name="salesStage" ng-pattern="/^[0-9][0-9]?$|^100$/" restrict-to="[0-9]"
							 ng-model="editDealProj.sales_stage" placeholder="Sales Stage in Percentage" name="value" ng-class="{submitting:((editDeal.salesStage.$error.required  || editDeal.salesStage.$error.pattern) && editDeal.salesStage.$touched)}"
							 required>
							<div ng-messages="editDeal.salesStage.$error" class="errormainpage">
								<div ng-message="pattern" ng-if="editDeal.salesStage.$touched">The number must be between 0-100.</div>
								<div ng-message="required" ng-if="editDeal.salesStage.$touched">Can't leave this empty.</div>
							</div>
						</div>
					</div>

					<div class="spacinga" id="sub-left">
						<div class="form-group">
							<div>
								<label class="convertToblack">Remarks:</label>
							</div>
							<textarea class="forInput form-control" wrap="soft" rows="5" type="text" size="255" placeholder="Remarks" name="remarks"
							 ng-model="editDealProj.remarks"></textarea>
						</div>
					</div>

					<div class="spacinga" id="sub-rightedit">
						<div class="form-group">
							<div>
								<label class="convertToblack">PO-Number:</label>
							</div>
							<input class="forInput form-control" id="ponumber" type="text" placeholder="PO-Number" name="ponumber" ng-model="editDealProj.po_num"
							 ng-class="{submitting:((editDeal.ponumber.$error.required  || editDeal.ponumber.$error.pattern) && editDeal.ponumber.$touched)}"
							 required restrict-to="[0-9]">
							<div ng-messages="editDeal.ponumber.$error" class="errormainpage">
								<div ng-message="required" ng-if="editDeal.ponumber.$touched">Can't leave this empty.</div>
							</div>
						</div>
					</div>

					<div class="spacing" id="sub-rightedit">
						<div class="form-group">
							<div>
								<label class="convertToblack">PO-Date:</label>
							</div>
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" onkeypress="return false;" ng-model="editDealProj.po_date" type="text"
								 placeholder="PO-Date: DD-MM-YYYY" name="podate" required ng-class="{submitting:editDeal.podate.$error.required && editDeal.podate.$touched}">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
								<div ng-messages="editDeal.podate.$error" class="errormainpage">
									<div ng-message="required" ng-if="editDeal.podate.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clear-both"></div>

					<div id="sub-left">
						<div class="form-group">
							<div>
								<label class="convertToblack">Start Date:</label>
							</div>
							<div class="datepicker modaldate form-group" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker " onkeypress="return false;" ng-model="editDealProj.start_date" type="text"
								 placeholder="Start Date: DD-MM-YYYY" name="startdate" required ng-class="{submitting:editDeal.startdate.$error.required && editDeal.startdate.$touched}">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
								<div ng-messages="editDeal.startdate.$error" class="errormainpage">
									<div ng-message="required" ng-if="editDeal.startdate.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>
					</div>

					<div id="sub-rightedit">
						<div class="form-group">
							<div>
								<label class="convertToblack">End Date:</label>
							</div>
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" onkeypress="return false;" ng-model="editDealProj.close_at" type="text"
								 placeholder="End Date: DD-MM-YYYY" name="enddate">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
							</div>
						</div>
					</div>
					<div class="clear-both"></div>
				</div>


				<div class="modal-footer">
					<button type="submit" ng-click="editDealRow(editDeal)" class="button modalsubmit">Submit</button>
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
			<form id="addDeal" name="addDeal" class="form-group" novalidate>
				<div class="modal-body" style="overflow-y: auto; max-height:450px;">
					<h4> Please fill in the form to add new Deal.</h4>
					<div class="SectionBox">
						<h5>Company and Contact:</h5>
						<input type="hidden" ng-model="Dealproj.project_category" />
						<div class="form-group">
							<select class="forInput form-control" id="companyselect"  ng-model="Dealproj.company_name" ng-change="watchselectDeal()"  ng-options="company.company_name as company.company_name for company in companies track by company.id"
							 ng-disabled="addcompany" name="companyName" ng-class="{submitting:addDeal.companyName.$error.required && addDeal.companyName.$touched}"
							 required>
								<option value=""  default selected>Select the Company</option>
							</select>
							<a href="#" id="addIcon">
								<span id="addIcon" class="glyphicon glyphicon-plus-sign" ng-init="showAddDeal=false" ng-click="showAddDeal=!showAddDeal; addcompany=!addcompany; watchselectDeal(); resetSelect()"></span>
							</a>
							<div class="errormainpage form-group">
								<div ng-show="addDeal.companyName.$error.required" ng-if="(addDeal.companyName.$touched && (!Dealproj.addCompanyName || !Dealproj.companyWebsite || !Dealproj.companyPhone 
                                                && !Dealproj.companyAddress || !Dealproj.industry || !Dealproj.contactPerson || !Dealproj.contPerEmail || !Dealproj.contPerPhone || !Dealproj.contPerPos))">You either need to select the company or add new company.</div>
							</div>
						</div>
						<div ng-show="showAddDeal">
							<div class="form-group spacinga">
								<div class="form-inline">
									<div class="form-group">
										<input class="forInput form-control" type="text" name="addCompanyName" ng-model="Dealproj.company_name" placeholder="Company name"
										 ng-class="{submitting:addDeal.addCompanyName.$error.required && addDeal.addCompanyName.$touched}"
										 ng-required="foraddnewcompany">
										<div class="errormainpage">
											<div ng-show="addDeal.addCompanyName.$error.required" ng-if="addDeal.addCompanyName.$touched">Can't leave this empty.</div>
										</div>
									</div>
									<div class="form-group">
										<input class="forInput form-control" type="text" ng-pattern="/^(((ht|f)tp(s?))\://)?(www.|[a-zA-Z].)[a-zA-Z0-9\-\.]+\.(com|edu|gov|mil|net|org|biz|info|name|museum|us|ca|uk)(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\;\?\'\\\+&amp;%\$#\=~_\-]+))*$/"
										 name="companyWebsite" ng-model="Dealproj.website" placeholder="Company Website" ng-class="{submitting:addDeal.companyWebsite.$error.required && addDeal.companyWebsite.$touched &&  !Dealproj.companyID}"
										 ng-required="foraddnewcompany">
										<div class="errormainpage" ng-messages="addDeal.companyWebsite.$error">
											<div ng-message="required" ng-if="addDeal.companyWebsite.$touched">Can't leave this empty.</div>
											<div ng-message="pattern" ng-if="addDeal.companyWebsite.$touched ">Wrong website format.</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group spacinga">
								<div class="form-inline">
									<div class="form-group" id="registerpassword">
										<input class="forInput form-control" type="text" name="companyPhone" ng-model="Dealproj.office_number" ng-maxlength="10" placeholder="Company Office Phone Number"
										 ng-class="{submitting:((addDeal.companyPhone.$error.required || addDeal.companyPhone.$error.maxlength) && addDeal.companyPhone.$touched &&  !Dealproj.companyID)}"
										 ng-required="foraddnewcompany" restrict-to="[0-9]" popover="Example: 037463325" popover-placement="bottom" popover-trigger="mouseenter">
										<div ng-messages="addDeal.companyPhone.$error" class="errormainpage">
											<div ng-message="required" ng-if="addDeal.companyPhone.$touched && !Dealproj.companyID">Can't leave this empty.</div>
											<div ng-message="maxlength" ng-if="addDeal.companyPhone.$touched && !Dealproj.companyID">Maximum length is 10 numbers.</div>
										</div>
									</div>
									<div class="form-group">
										<input class="forInput form-control" only-letters-input type="text" name="contactPerson" ng-model="Dealproj.contact_name"
										 placeholder="Contact Person Name" ng-class="{submitting:addDeal.contactPerson.$error.required && addDeal.contactPerson.$touched &&  !Dealproj.companyID}"
										 ng-required="foraddnewcompany">
										<div class="errormainpage">
											<div ng-show="addDeal.contactPerson.$error.required" ng-if="addDeal.contactPerson.$touched && !Dealproj.companyID">Can't leave this empty.</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group spacinga">
								<div class="form-inline">
									<div class="form-group">
										<select class="forInput form-control" name="industry" ng-model="Dealproj.industry" ng-options="industry.id as industry.industry for industry in industryList"
										 ng-class="{submitting:addDeal.industry.$error.required && addDeal.industry.$touched &&  !Dealproj.companyID}" ng-required="foraddnewcompany">
											<option value="" default disabled selected>Select the Industry</option>
										</select>
										<div class="errormainpage">
											<div ng-show="addDeal.industry.$error.required" ng-if="addDeal.industry.$touched && !Dealproj.companyID">Can't leave this empty.</div>
										</div>
									</div>
									<div class="form-group">
										<input class="forInput form-control" type="text" only-letters-input name="contPerPos" ng-model="Dealproj.contact_designation" placeholder="Contact Person Position"
										 ng-class="{submitting:addDeal.contPerPos.$error.required && addDeal.contPerPos.$touched &&  !Dealproj.companyID}"
										 ng-required="foraddnewcompany">
										<div class="errormainpage">
											<div ng-show="addDeal.contPerPos.$error.required" ng-if="addDeal.contPerPos.$touched && !Dealproj.companyID">Can't leave this empty.</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group spacinga">
								<div class="form-inline">
									<div class="form-group">
										<input class="forInput form-control" type="email" name="contPerEmail" ng-model="Dealproj.contact_email" placeholder="Contact Person Email"
										 ng-class="{submitting: ((addDeal.contPerEmail.$error.email || addDeal.contPerEmail.$error.required && !Dealproj.companyID) && addDeal.contPerEmail.$touched)}"
										 ng-required="foraddnewcompany">
										<div ng-messages="addDeal.contPerEmail.$error" class="errormainpage">
											<div ng-message="email" ng-if="addDeal.contPerEmail.$touched && !Dealproj.companyID">Wrong email format.</div>
											<div ng-message="required" ng-if="addDeal.contPerEmail.$touched && !Dealproj.companyID">Can't leave this empty.</div>
										</div>
									</div>
									<div class="form-group" id="registerpassword">
										<input class="forInput form-control" type="text" name="contPerPhone" ng-maxlength="15" ng-model="Dealproj.contact_number"
										 placeholder="Contact Person Phone Number" ng-class="{submitting:((addDeal.contPerPhone.$error.required || addDeal.contPerPhone.$error.maxlength) && addDeal.contPerPhone.$touched && !Dealproj.companyID)}"
										 ng-required="foraddnewcompany" popover="Example: 0172345464" popover-placement="bottom" popover-trigger="mouseenter" restrict-to="[0-9]">
										<div ng-messages="addDeal.contPerPhone.$error" class="errormainpage">
											<div ng-message="required" ng-if="addDeal.contPerPhone.$touched && !Dealproj.companyID">Can't leave this empty.</div>
											<div ng-message="maxlength" ng-if="addDeal.contPerPhone.$touched && !Dealproj.companyID">Maximum length is 15 numbers.</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="SectionBox">
						<h5>Deal Information:</h5>
						<div class="form-group">
							<div class="form-inline">
								<div class="form-group">
									<select class="forInput form-control" name="salesPerson" ng-model="Dealproj.salesperson_id" ng-options="salesperson.salesperson_id as salesperson.name for salesperson in salespersonList track by salesperson.id" ng-class="{submitting:addDeal.salesPerson.$error.required && addDeal.salesPerson.$touched}"
									 required>
										<option value="" default disabled selected>Select the Person in Charge</option>
									</select>
									<div class="errormainpage">
										<div ng-show="addDeal.salesPerson.$error.required" ng-if="addDeal.salesPerson.$touched">Can't leave this empty.</div>
									</div>
								</div>
								<div class="form-group">
									<select class="forInput form-control" ng-model="Dealproj.project_type" name="typeID" ng-options="type.name as type.name for type in types track by type.id"
									 ng-class="{submitting:addDeal.typeID.$error.required && addDeal.typeID.$touched}" required>
										<option value="" default disabled selected>Select the Type of Project</option>
									</select>
									<div class="errormainpage">
										<div ng-show="addDeal.typeID.$error.required" ng-if="addDeal.typeID.$touched">Can't leave this empty.</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group spacinga">
							<div class="form-inline">
								<div class="form-group">
									<select class="forInput form-control" ng-model="Dealproj.product" ng-options="product.id as product.product_name for product in productList"
									 name="product" ng-class="{submitting:addDeal.product.$error.required && addDeal.product.$touched}" required>
										<option value="" default disabled selected>Select the Product</option>
									</select>
									<div class="errormainpage">
										<div ng-show="addDeal.product.$error.required" ng-if="addDeal.product.$touched">Can't leave this empty.</div>
									</div>
								</div>
								<div class="form-group">
									<input class="forInput form-control" type="text" ng-model="Dealproj.value" placeholder="Value" restrict-to="[0-9]" name="value"
									 ng-class="{submitting:addDeal.value.$error.required && addDeal.value.$touched}" required>
									<div class="errormainpage">
										<div ng-show="addDeal.value.$error.required" ng-if="addDeal.value.$touched">Can't leave this empty.</div>
									</div>
								</div>
							</div>
						</div>
						<div class="spacinga">
							<div class="form-inline">
								<div class="form-group">
									<input class="forInput form-control" type="text" name="salesStage" ng-pattern="/^[0-9][0-9]?$|^100$/" restrict-to="[0-9]"
									 ng-model="Dealproj.sales_stage" placeholder="Sales Stage in Percentage" name="value" ng-class="{submitting:((addDeal.salesStage.$error.required  || addDeal.salesStage.$error.pattern) && addDeal.salesStage.$touched)}"
									 required>
									<div ng-messages="addDeal.salesStage.$error" class="errormainpage">
										<div ng-message="pattern" ng-if="addDeal.salesStage.$touched">The number must be between 0-100.</div>
										<div ng-message="required" ng-if="addDeal.salesStage.$touched">Can't leave this empty.</div>
									</div>
								</div>
								<div class="form-group">
									<input class="forInput form-control" id="ponumber" type="text" placeholder="PO-Number" name="ponumber" ng-model="Dealproj.po_number"
									 ng-class="{submitting:((addDeal.ponumber.$error.required  || addDeal.ponumber.$error.pattern) && addDeal.ponumber.$touched)}"
									 required restrict-to="[0-9]">
									<div ng-messages="addDeal.ponumber.$error" class="errormainpage">
										<div ng-message="required" ng-if="addDeal.ponumber.$touched">Can't leave this empty.</div>
									</div>
								</div>
							</div>
						</div>
						<div id="sub-left" class="spacinga">
							<textarea class="forInput form-control" wrap="soft" rows="6" type="text" size="255" placeholder="Remarks" name="remarks"
							 ng-model="Dealproj.remarks"></textarea>
						</div>
						<div id="sub-right" class="spacinga">
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" onkeypress="return false;" ng-model="Dealproj.po_date" type="text" placeholder="PO-Date: DD-MM-YYYY"
								 name="podate" required ng-class="{submitting:addDeal.podate.$error.required && addDeal.podate.$touched}">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
								<div ng-messages="addDeal.podate.$error" class="errormainpage">
									<div ng-message="required" ng-if="addDeal.podate.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>
						<div id="sub-right" class="spacinga">
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" onkeypress="return false;" ng-model="Dealproj.start_date" type="text"
								 placeholder="Start Date: DD-MM-YYYY" name="startdate" required ng-class="{submitting:addDeal.startdate.$error.required && addDeal.startdate.$touched}">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
								<div ng-messages="addDeal.startdate.$error" class="errormainpage">
									<div ng-message="required" ng-if="addDeal.startdate.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>
						<div id="sub-right" class="spacinga">
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" onkeypress="return false;" ng-model="Dealproj.close_at" type="text"
								 placeholder="End Date: DD-MM-YYYY" name="enddate">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
							</div>
						</div>


						<div class="clear-both"></div>

					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" ng-click="postAddDealForm(addDeal)" class="button modalsubmit">Submit</button>
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
			<form class="form-group" name="editindustrys">
				<div class="modal-body" style="overflow-y: auto; max-height:400px;min-height:400px;">
					<div>
						<input class="forInput form-control " id="industrytxf" ng-model="industry" type="text" placeholder="Industry Name">
						<a href="#" id="addIcon" ng-click="addIndustry(industry)">
							<span id="addIcon" class="glyphicon glyphicon-plus-sign"></span>
						</a>
					</div>
					<div ng-repeat="ind in industryList" class="spacing">
						<div style="background-color:rgb(227, 227, 228);" class="listtext">
							@{{ind.industry}}
							<a href="#" ng-click="deleteSelected($index,ind)">
								<span class="glyphicon glyphicon-remove" style="color:#D32F2F;font-size:13px;float:right;"></span>
						</div>
					</div>
				</div>
			<a href="#" ng-click="close()" style=" position:absolute;top:10px;left:273px;">
				<span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
			</a>
		</div>
	</script>

	<script type="text/ng-template" id="editlead.html">
		<div class="modal-content">
			<div class="modal-header" style="height:40px;">
				<h3>Edit Lead</h3>
			</div>
			<form id="editlead" name="editLead" class="form-group" novalidate>
				<div class="modal-body" style="overflow-y: auto; max-height:400px;">

					<div class="form-inline spacingedit">
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Company Name:</label>
							</div>
							<input class="forInput form-control" ng-model="editLeadProj.company_name" ng-disabled="true" />
						</div>
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Project Type:</label>
							</div>
							<select class="forInput form-control" ng-model="editLeadProj.project_type" name="typeID" ng-options="type.name as type.name for type in types"
							 ng-class="{submitting:editLead.typeID.$error.required && editLead.typeID.$touched}" required>
								<option value="" default disabled selected>Select the Type of Project</option>
							</select>
							<div class="errormainpage">
								<div ng-show="editLead.typeID.$error.required" ng-if="editLead.typeID.$touched">Can't leave this empty.</div>
							</div>
						</div>
					</div>
					<div class="form-inline spacinga">
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Product:</label>
							</div>
							<select class="forInput form-control" ng-model="editLeadProj.product" ng-options="product.id as product.product_name for product in productList"
							 name="product" ng-class="{submitting:editLead.product.$error.required && editLead.product.$touched}" required>
								<option value="" default disabled selected>Select the Product</option>
							</select>
							<div class="errormainpage">
								<div ng-show="editLead.product.$error.required" ng-if="editLead.product.$touched">Can't leave this empty.</div>
							</div>
						</div>

						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Value:</label>
							</div>
							<input class="forInput form-control" type="text" ng-model="editLeadProj.value" placeholder="Value" restrict-to="[0-9]" name="value"
							 ng-class="{submitting:editLead.value.$error.required && editLead.value.$touched}" required>
							<div class="errormainpage">
								<div ng-show="editLead.value.$error.required" ng-if="editLead.value.$touched">Can't leave this empty.</div>
							</div>
						</div>
					</div>

					<div class="form-inline spacinga">
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Sales Stage:</label>
							</div>
							<input class="forInput form-control" type="text" name="salesStage" ng-pattern="/^[0-9][0-9]?$|^100$/" restrict-to="[0-9]"
							 ng-model="editLeadProj.sales_stage" placeholder="Sales Stage in Percentage" name="value" ng-class="{submitting:((editLead.salesStage.$error.required  || editLead.salesStage.$error.pattern) && editLead.salesStage.$touched)}"
							 required>
							<div ng-messages="editLead.salesStage.$error" class="errormainpage">
								<div ng-message="pattern" ng-if="editLead.salesStage.$touched">The number must be between 0-100.</div>
								<div ng-message="required" ng-if="editLead.salesStage.$touched">Can't leave this empty.</div>
							</div>
						</div>
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Project Category:</label>
							</div>
							<select class="forInput form-control" id="ponumber" ng-model="editLeadProj.project_category" ng-options="cat.name as cat.name for cat in cats"
							 ng-change="selectedItemChanged()">
								<option value="" default disabled selected>Select the Category</option>
							</select>
						</div>
					</div>

					<div class="form-inline spacinga">
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Start Date:</label>
							</div>
							<div class="datepicker modaldate form-group" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker " onkeypress="return false;" ng-model="editLeadProj.start_date" type="text"
								 placeholder="Start Date: DD-MM-YYYY" name="startdate" required ng-class="{submitting:editLead.startdate.$error.required && editLead.startdate.$touched}">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
								<div ng-messages="editLead.startdate.$error" class="errormainpage">
									<div ng-message="required" ng-if="editLead.startdate.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">End Date:</label>
							</div>
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" onkeypress="return false;" ng-model="editLeadProj.close_at" type="text"
								 placeholder="End Date: DD-MM-YYYY" name="enddate">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
							</div>
						</div>
					</div>

					<div ng-show="editLeadProj.project_category =='Deal'">
						<div class="form-inline spacinga">
							<div class="form-group">
								<div class="labelbottomspace">
									<lable class="convertToblack">PO-Number:</label>
								</div>
								<div>
									<input class="forInput form-control" id="ponumber" type="text" placeholder="PO-Number" name="ponumber" ng-model="editLeadProj.po_number"
									 ng-class="{submitting:((editLead.ponumber.$error.required  || editLead.ponumber.$error.pattern) && editLead.ponumber.$touched)}"
									 ng-required="checkdeal" restrict-to="[0-9]">
									<div ng-messages="editLead.ponumber.$error" class="errormainpage">
										<div ng-message="required" ng-if="editLead.ponumber.$touched">Can't leave this empty.</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="labelbottomspace">
									<lable class="convertToblack">PO-Date:</label>
								</div>
								<div class="datepicker modaldate" date-format="dd-MM-yyyy">
									<input class="forInput form-control modaldatepicker" onkeypress="return false;" ng-model="editLeadProj.po_date" type="text"
									 placeholder="PO-Date: DD-MM-YYYY" name="podate" ng-required="checkdeal" ng-class="{submitting:editLead.podate.$error.required && editLead.podate.$touched}">
									<i class="fa fa-calendar fafaPosititionondatepicker"></i>
									</input>
									<div ng-messages="editLead.podate.$error" class="errormainpage">
										<div ng-message="required" ng-if="editLead.podate.$touched">Can't leave this empty.</div>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div ng-hide="editLeadProj.project_category !='Lead'">
						<div class="form-inline spacinga">
							<div class="form-group">
								<div class="labelbottomspace">
									<lable class="convertToblack">Status:</label>
								</div>
								<select class="forInput form-control" name="statusID" ng-model="editLeadProj.status" ng-options="status.name as status.name for status in statuses"
								 ng-class="{submitting:editLead.statusID.$error.required && editLead.statusID.$touched}" required>
									<option value="" default disabled selected>Select the Status</option>
								</select>
								<div class="errormainpage">
									<div ng-show="editLead.statusID.$error.required" ng-if="editLead.statusID.$touched">Can't leave this empty.</div>
								</div>

							</div>

							<div class="form-group">
								<div class="labelbottomspace">
									<label class="convertToblack">Tender:</label>
								</div>
								<select class="forInput form-control" name="tender" ng-model="editLeadProj.tender" ng-options="tender.name as tender.name for tender in tenders"
								 ng-class="{submitting:editLead.tender.$error.required && editLead.tender.$touched}" required>
									<option value="" default disabled selected>Select the Tender</option>
								</select>
								<div class="errormainpage">
									<div ng-show="editLead.tender.$error.required" ng-if="editLead.tender.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>
					</div>
					<div id="sub-left">
						<div class="spacinga form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Remarks:</label>
							</div>
							<textarea class="forInput form-control" wrap="soft" rows="5" ng-model="editLeadProj.remarks" type="text" size="255" placeholder="Remarks"></textarea>
						</div>
					</div>

					<div class="spacinga" ng-hide="editLeadProj.project_category =='Lost case'">
						<div id="sub-rightedit">
							<div class="form-group">
								<div class="labelbottomspace">
									<lable class="convertToblack">Person in Charge:</label>
								</div>
								<select class="forInput form-control" name="salesPerson" ng-model="editLeadProj.salesperson_id" ng-options="salesperson.salesperson_id as salesperson.name for salesperson in salespersonList" ng-class="{submitting:editLead.salesPerson.$error.required && editLead.salesPerson.$touched}"
								 required>
									<option value="" default disabled selected>Select the Person in Charge</option>
								</select>
								<div ng-messages="editLead.salesPerson.$error" class="errormainpage">
									<div ng-message="required" ng-if="editLead.salesPerson.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" ng-click="editLeadRow(editLead)" class="button modalsubmit">Submit</button>
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
				<h3>Edit Lost Case</h3>
			</div>
			<form id="editlostcase" name="editlostcase" class="form-group" novalidate>
				<div class="modal-body" style="overflow-y: auto; max-height:450px;">

					<div class="form-inline spacingedit">
						<div class="form-group">
							<div>
								<label class="convertToblack">Company Name:</label>
							</div>
							<input type="text" class="forInput form-control" ng-model="editlostProj.company_name" ng-disabled="true"/>
						</div>
						<div class="form-group">
							<div>
								<label class="convertToblack">Project Type:</label>
							</div>
							<select class="forInput form-control" ng-model="editlostProj.project_type" name="typeID" ng-options="type.name as type.name for type in types"
							 ng-class="{submitting:editlostcase.typeID.$error.required && editlostcase.typeID.$touched}" required>
								<option value="" default disabled selected>Select the Type of Project</option>
							</select>
							<div class="errormainpage">
								<div ng-show="editlostcase.typeID.$error.required" ng-if="editlostcase.typeID.$touched">Can't leave this empty.</div>
							</div>
						</div>
					</div>

					<div class="form-inline spacinga">
						<div class="form-group">
							<div>
								<label class="convertToblack">Product:</label>
							</div>
							<select class="forInput form-control" ng-model="editlostProj.product" name="product" ng-options="product.id as product.product_name for product in productList" ng-class="{submitting:editlostcase.product.$error.required && editlostcase.product.$touched}"
							 required>
								<option value="" default disabled selected>Select the Product</option>
							</select>
							<div class="errormainpage">
								<div ng-show="editlostcase.product.$error.required" ng-if="editlostcase.product.$touched">Can't leave this empty.</div>
							</div>
						</div>
						<div class="form-group">
							<div>
								<label class="convertToblack">Value:</label>
							</div>
							<input class="forInput form-control" type="text" ng-model="editlostProj.value" placeholder="Value" restrict-to="[0-9]" name="value"
							 ng-class="{submitting:editlostcase.value.$error.required && editlostcase.value.$touched}" required>
							<div class="errormainpage">
								<div ng-show="editlostcase.value.$error.required" ng-if="editlostcase.value.$touched">Can't leave this empty.</div>
							</div>
						</div>
					</div>


					<div class="form-inline spacinga">
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">Start Date:</label>
							</div>
							<div class="datepicker modaldate form-group" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker " onkeypress="return false;" ng-model="editlostProj.start_date" type="text"
								 placeholder="Start Date: DD-MM-YYYY" name="startdate" required ng-class="{submitting:editlostcase.startdate.$error.required && editlostcase.startdate.$touched}">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
								<div ng-messages="editlostcase.startdate.$error" class="errormainpage">
									<div ng-message="required" ng-if="editlostcase.startdate.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="labelbottomspace">
								<lable class="convertToblack">End Date:</label>
							</div>
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" ng-model="editlostProj.close_at" type="text" placeholder="End Date">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>
								</input>
							</div>
						</div>
					</div>

					<div class="form-group spacinga">
						<div>
							<label class="convertToblack">Remarks:</label>
						</div>
						<textarea class="forInput form-control" wrap="soft" rows="5" type="text" size="255" placeholder="Remarks" ng-model="editlostProj.remarks"
						></textarea>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" ng-click="editLostRow(editlostcase)" class="button modalsubmit">Submit</button>
				</div>

				<a href="#" ng-click="close()" style=" position:absolute;top:10px;left:573px;">
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
						<input class="forInput form-control" id="industrytxf" ng-model="product" type="text" placeholder="Product Name">
						<a href="#" id="addIcon" ng-click="addProduct(product)">
							<span id="addIcon" class="glyphicon glyphicon-plus-sign"></span>
						</a>
					</div>
					<div ng-repeat="prod in productList" class="spacing">
						<div style="background-color:rgb(227, 227, 228);" class="listtext">
							@{{prod.product_name}}
							<a href="#" ng-click="deleteSelected($index,prod)">
								<span class="glyphicon glyphicon-remove" style="color:#D32F2F;font-size:13px;float:right;"></span>
						</div>
					</div>
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
				<h3>Edit Sales Person</h3>
			</div>
			<form id="editsalesperson" name="editsalesperson" class="form-group" novalidate>
				<div class="modal-body" style="overflow-y: auto; max-height:450px;">
					<div class="form-group spacing">
						<div class="labelbottomspace">
							<lable class="convertToblack">Name:</label>
						</div>
						<input class="forInput form-control" only-letters-input type="text" name="salespername" ng-model="editSperson.name" ng-class="{submitting: editsalesperson.salespername.$error.required && editsalesperson.salespername.$touched }"
						 placeholder="Name" required>
						<div class="errormainpage" ng-show="editsalesperson.salespername.$error.required" ng-if="editsalesperson.salespername.$touched">Can't leave this empty.</div>
					</div>
					<div class="form-group spacingedit" id="registerpassword">
						<div class="labelbottomspace">
							<lable class="convertToblack">Phone:</label>
						</div>
						<input class="forInput form-control" type="text" name="salesperphone" ng-model="editSperson.phone_num" ng-class="{submitting: editsalesperson.salesperphone.$error.required && editsalesperson.salesperphone.$touched }"
						 restrict-to="[0-9]" placeholder="Phone" required popover="Example: 0172345464" popover-placement="bottom" popover-trigger="mouseenter">
						<div class="errormainpage" ng-show="editsalesperson.salesperphone.$error.required" ng-if="editsalesperson.salesperphone.$touched">Can't leave this empty.</div>
					</div>
					<div class="form-group spacingedit">
						<div class="labelbottomspace">
							<lable class="convertToblack">Email:</label>
						</div>
						<input class="forInput form-control" type="email" name="salesperemail" ng-model="editSperson.email" ng-class="{submitting: editsalesperson.salesperemail.$error.required && editsalesperson.salesperemail.$touched }"
						 placeholder="Email" required>
						<div ng-messages="editsalesperson.salesperemail.$error" class="errormainpage">
							<div ng-message="email" ng-if="editsalesperson.salesperemail.$touched">Wrong email format.</div>
							<div ng-message="required" ng-if="editsalesperson.salesperemail.$touched">Can't leave this empty.</div>
						</div>
					</div>
					<div class="form-group spacingedit">
						<div class="labelbottomspace">
							<lable class="convertToblack">ID:</label>
						</div>
						<input class="forInput form-control" type="text" name="salesperId" ng-model="editSperson.salesperson_id" ng-class="{submitting: editsalesperson.salesperId.$error.required && editsalesperson.salesperId.$touched }"
						 placeholder="ID" required>
						<div class="errormainpage" ng-show="editsalesperson.salesperId.$error.required" ng-if="editsalesperson.salesperId.$touched">Can't leave this empty.</div>
					</div>

					<div class="form-group spacingedit">
						<div class="labelbottomspace">
							<lable class="convertToblack">Position:</label>
						</div>
						<input class="forInput form-control" type="text" only-letters-input name="salesperpos" ng-model="editSperson.position" ng-class="{submitting: editsalesperson.salesperpos.$error.required && editsalesperson.salesperpos.$touched }"
						 placeholder="Position" required>
						<div class="errormainpage" ng-show="editsalesperson.salesperpos.$error.required" ng-if="editsalesperson.salesperpos.$touched">Can't leave this empty.</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" ng-click="editPersRow(editsalesperson)" class="button modalsubmit1">Submit</button>
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
				<a href="#" ng-click=close() style=" position:absolute;top:10px;left:573px;">
					<span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
				</a>
			</div>


			<div class="modal-body" style="overflow-y: auto; max-height:450px;">
				<form id="addLead" name="addLead" class="form-group" novalidate>
					<h4> Please fill in the form to add new lead.</h4>
					<div class="SectionBox">
						<h5>Company and Contact:</h5>
						<input type="hidden" ng-model="leadproj.project_category" />
						<div class="form-group">
							<select class="forInput form-control" id="companyselect" ng-model="leadproj.company_name" ng-change="watchselect()" ng-options="company.company_name as company.company_name for company in companies track by company.id" value="company.company_name" 
							 ng-disabled="addcompany" name="companyName" ng-class="{submitting:addLead.companyName.$error.required && addLead.companyName.$touched}"
							 required>
								<option value="" default selected>Select the Company</option>
							</select>
							<a href="#" id="addIcon">
								<span id="addIcon" class="glyphicon glyphicon-plus-sign" ng-init="showAdd=false " ng-click="showAdd=!showAdd; addcompany=!addcompany; resetSelect();watchselect()"></span>
							</a>
							<div class="errormainpage form-group">
								<div ng-show="addLead.companyName.$error.required" ng-if="(addLead.companyName.$touched && (!leadproj.company_name || !leadproj.website || !leadproj.office_number 
                                             || !leadproj.industry || !leadproj.contact_name || !leadproj.contact_email || !leadproj.contact_number || !leadproj.contact_designation))">You either need to select the company or add new company.</div>
							</div>
						</div>
					
						<div ng-show="showAdd">
							<div class="form-group spacinga">
								<div class="form-inline">
									<div class="form-group">
										<input class="forInput form-control" type="text" name="addCompanyName" ng-model="leadproj.company_name"  placeholder="Company name"
										 ng-class="{submitting:addLead.addCompanyName.$error.required && addLead.addCompanyName.$touched}"
										 ng-required="foraddnewcompany">
										<div class="errormainpage">
											<div ng-show="addLead.addCompanyName.$error.required" ng-if="addLead.addCompanyName.$touched">Can't leave this empty.</div>
										</div>
									</div>

									<div class="form-group">
										<input class="forInput form-control" type="text" ng-pattern="/^(((ht|f)tp(s?))\://)?(www.|[a-zA-Z].)[a-zA-Z0-9\-\.]+\.(com|edu|gov|mil|net|org|biz|info|name|museum|us|ca|uk)(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\;\?\'\\\+&amp;%\$#\=~_\-]+))*$/"
										 name="companyWebsite" ng-model="leadproj.website" placeholder="Company Website" ng-class="{submitting:(addLead.companyWebsite.$error.required || addLead.companyWebsite.$error.pattern) && addLead.companyWebsite.$touched}"
										 ng-required="foraddnewcompany">
										<div class="errormainpage" ng-messages="addLead.companyWebsite.$error">
											<div ng-message="required" ng-if="addLead.companyWebsite.$touched">Can't leave this empty.</div>
											<div ng-message="pattern" ng-if="addLead.companyWebsite.$touched">Wrong website format.</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group spacinga">
								<div class="form-inline">
									<div class="form-group" id="registerpassword">
										<input class="forInput form-control" type="text" name="companyPhone" ng-model="leadproj.office_number" ng-maxlength="10" placeholder="Company Office Phone Number"
										 ng-class="{submitting:((addLead.companyPhone.$error.required || addLead.companyPhone.$error.maxlength) && addLead.companyPhone.$touched)}"
										 ng-required="foraddnewcompany" restrict-to="[0-9]" popover="Example: 037463325" popover-placement="bottom" popover-trigger="mouseenter">
										<div ng-messages="addLead.companyPhone.$error" class="errormainpage">
											<div ng-message="required" ng-if="addLead.companyPhone.$touched">Can't leave this empty.</div>
											<div ng-message="maxlength" ng-if="addLead.companyPhone.$touched">Maximum length is 10 numbers.</div>
										</div>
									</div>
									<div class="form-group">
										<input class="forInput form-control" only-letters-input type="text" name="contactPerson" ng-model="leadproj.contact_name"
										 placeholder="Contact Person Name" ng-class="{submitting:addLead.contactPerson.$error.required && addLead.contactPerson.$touched}"
										 ng-required="foraddnewcompany">
										<div class="errormainpage">
											<div ng-show="addLead.contactPerson.$error.required" ng-if="addLead.contactPerson.$touched">Can't leave this empty.</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group spacinga">
								<div class="form-inline">
									<div class="form-group">
										<select class="forInput form-control" name="industry" ng-model="leadproj.industry" ng-options="industry.id as industry.industry for industry in industryList" ng-class="{submitting:addLead.industry.$error.required && addLead.industry.$touched}"
										 ng-required="foraddnewcompany">
											<option value="" default disabled selected>Select the Industry</option>
										</select>
										<div class="errormainpage">
											<div ng-show="addLead.industry.$error.required" ng-if="addLead.industry.$touched ">Can't leave this empty.</div>
										</div>
									</div>
									<div class="form-group">
										<input class="forInput form-control" type="text" only-letters-input name="contPerPos" ng-model="leadproj.contact_designation" placeholder="Contact Person Position"
										 ng-class="{submitting:addLead.contPerPos.$error.required && addLead.contPerPos.$touched}"
										 ng-required="foraddnewcompany">
										<div class="errormainpage">
											<div ng-show="addLead.contPerPos.$error.required" ng-if="addLead.contPerPos.$touched">Can't leave this empty.</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group spacinga">
								<div class="form-inline">
									<div class="form-group">
										<input class="forInput form-control" type="email" name="contPerEmail" ng-model="leadproj.contact_email" placeholder="Contact Person Email"
										 ng-class="{submitting: ((addLead.contPerEmail.$error.email || addLead.contPerEmail.$error.required) && addLead.contPerEmail.$touched)}"
										 ng-required="foraddnewcompany">
										<div ng-messages="addLead.contPerEmail.$error" class="errormainpage">
											<div ng-message="email" ng-if="addLead.contPerEmail.$touched">Wrong email format.</div>
											<div ng-message="required" ng-if="addLead.contPerEmail.$touched">Can't leave this empty.</div>
										</div>
									</div>
									<div class="form-group" id="registerpassword">
										<input class="forInput form-control" type="text" name="contPerPhone" ng-maxlength="15" ng-model="leadproj.contact_number" placeholder="Contact Person Phone Number"
										 ng-class="{submitting:((addLead.contPerPhone.$error.required || addLead.contPerPhone.$error.maxlength) && addLead.contPerPhone.$touched)}"
										 ng-required="foraddnewcompany" popover="Example: 0172345464" popover-placement="bottom" popover-trigger="mouseenter" restrict-to="[0-9]">
										<div ng-messages="addLead.contPerPhone.$error" class="errormainpage">
											<div ng-message="required" ng-if="addLead.contPerPhone.$touched">Can't leave this empty.</div>
											<div ng-message="maxlength" ng-if="addLead.contPerPhone.$touched">Maximum length is 15 numbers.</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="SectionBox">
						<h5>Lead Information:</h5>
						<div class="form-group">
							<div class="form-inline">
								<div class="form-group">
									<select class="forInput form-control" name="salesPerson" ng-model="leadproj.salesperson_id" ng-options="salesperson.salesperson_id as salesperson.name for salesperson in salespersonList track by salesperson.id" ng-class="{submitting:addLead.salesPerson.$error.required && addLead.salesPerson.$touched}"
									 required>
										<option value="" default disabled selected>Select the Person in Charge</option>
									</select>
									<div class="errormainpage">
										<div ng-show="addLead.salesPerson.$error.required" ng-if="addLead.salesPerson.$touched">Can't leave this empty.</div>
									</div>
								</div>
								<div class="form-group">
									<select class="forInput form-control" ng-model="leadproj.project_type" name="typeID" ng-options="type.name as type.name for type in types track by type.id"
									 ng-class="{submitting:addLead.typeID.$error.required && addLead.typeID.$touched}" required>
										<option value="" default disabled selected>Select the Type of Project</option>
									</select>
									<div class="errormainpage">
										<div ng-show="addLead.typeID.$error.required" ng-if="addLead.typeID.$touched">Can't leave this empty.</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group spacinga">
							<div class="form-inline">
								<div class="form-group">
									<select class="forInput form-control" ng-model="leadproj.product" name="product" ng-options="product.id as product.product_name for product in productList" ng-class="{submitting:addLead.product.$error.required && addLead.product.$touched}"
									 required>
										<option value="" default disabled selected>Select the Product</option>
									</select>
									<div class="errormainpage">
										<div ng-show="addLead.product.$error.required" ng-if="addLead.product.$touched">Can't leave this empty.</div>
									</div>
								</div>
								<div class="form-group">
									<input class="forInput form-control" type="text" ng-model="leadproj.value" placeholder="Value" restrict-to="[0-9]" name="value"
									 ng-class="{submitting:addLead.value.$error.required && addLead.value.$touched}" required>
									<div class="errormainpage">
										<div ng-show="addLead.value.$error.required" ng-if="addLead.value.$touched">Can't leave this empty.</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group spacinga">
							<div class="form-inline">
								<div class="form-group">
									<input class="forInput form-control" type="text" name="salesStage" ng-pattern="/^[0-9][0-9]?$|^100$/" restrict-to="[0-9]"
									 ng-model="leadproj.sales_stage" placeholder="Sales Stage in Percentage" name="value" ng-class="{submitting:((addLead.salesStage.$error.required  || addLead.salesStage.$error.pattern) && addLead.salesStage.$touched)}"
									 required>
									<div ng-messages="addLead.salesStage.$error" class="errormainpage">
										<div ng-message="pattern" ng-if="addLead.salesStage.$touched">The number must be between 0-100.</div>
										<div ng-message="required" ng-if="addLead.salesStage.$touched">Can't leave this empty.</div>
									</div>
								</div>
								<div class="form-group">
									<select class="forInput form-control" name="statusID" ng-model="leadproj.status" ng-options="status.name as status.name for status in statuses track by status.id"
									 ng-class="{submitting:addLead.statusID.$error.required && addLead.statusID.$touched}" required>
										<option value="" default disabled selected>Select the Status</option>
									</select>
									<div class="errormainpage">
										<div ng-show="addLead.statusID.$error.required" ng-if="addLead.statusID.$touched">Can't leave this empty.</div>
									</div>

								</div>
							</div>
						</div>

						<div id="sub-left" class="spacing">
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" onkeypress="return false;" ng-model="leadproj.start_date" type="text"
								 placeholder="Start Date: DD-MM-YYYY" name="startdate" required ng-class="{submitting:addLead.startdate.$error.required && addLead.startdate.$touched}">
								<i class="fa fa-calendar fafaPosititionondatepicker"></i>

								<div ng-messages="addLead.startdate.$error" class="errormainpage">
									<div ng-message="required" ng-if="addLead.startdate.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>

						<div id="sub-right" class="spacing">
							<div class="datepicker modaldate" date-format="dd-MM-yyyy">
								<input class="forInput form-control modaldatepicker" onkeypress="return false;" name="enddate" ng-model="leadproj.close_at"
								 type="text" placeholder="End Date: DD-MM-YYYY">
							</div>
						</div>

						<i class="fa fa-calendar fafaPosititionondatepickerend"></i>
						<div class="clear-both"></div>

						<div id="sub-left">
							<div class="form-group spacing">
								<select class="forInput form-control" name="tender" ng-model="leadproj.tender" ng-options="tender.name as tender.name for tender in tenders"
								 ng-class="{submitting:addLead.tender.$error.required && addLead.tender.$touched}" required>
									<option value="" default disabled selected>Select the Tender</option>
								</select>
								<div class="errormainpage">
									<div ng-show="addLead.tender.$error.required" ng-if="addLead.tender.$touched">Can't leave this empty.</div>
								</div>
							</div>
						</div>

						<div class="sub-right spacing">
							<textarea class="forInput form-control" wrap="soft" rows="5" ng-model="leadproj.remark" type="text" size="255" placeholder="Remarks"></textarea>
						</div>

					</div>
				</form>

			</div>
			<div class="modal-footer" style="height:70px;">
				<button type="submit" ng-click="postAddLeadForm(addLead)" class="button modalsubmit">Submit</button>
			</div>
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

	<script type="text/ng-template" id="forgotpass.html">
		<div>
			<div class="modal-header" style="height:40px;">
				<h3 id="forgoth3">Forgot your Password?</h3>
			</div>
			<form class="form-group" name="forgotpass" novalidate>
				<div class="modal-body" style="height:120px;">

					<h4 id="forgoth4"> Pleas enter your registered email. The link of changing password will be sent to your email.</h4>
					<div>
						<input class="form-control forInput" id="email" name="email" ng-model="user.email" type="email" placeholder="Email" ng-class="{submitting: forgotpass.email.$touched}"
						 required>
						<div ng-messages="forgotpass.email.$error" class="errormainpageforgot">
							<div ng-message="email" ng-if="forgotpass.email.$touched">Wrong email format.</div>
							<div ng-message="required" ng-if="forgotpass.email.$touched">Can't leave this empty.</div>
						</div>
					</div>

				</div>
				<div class="modal-footer" style="height:60px;">
					<!--for now we just close it later need to change the function!-->
					<button type="button" ng-click="emailSubmit(forgotpass)" id="passwordSubmit" class="button">Submit</button>
				</div>
				<a href="#" ng-click="close()" style=" position:fixed;top:10px;left:273px;">
					<span class="glyphicon glyphicon-remove" style="color: white;font-size:17px;"></span>
				</a>

			</form>
		</div>
	</script>

	<!-- Modal pages scripts section end  -->

</body>

</html>