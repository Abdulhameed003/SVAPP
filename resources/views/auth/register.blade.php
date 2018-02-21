@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="registerController">
        <div id="loginleftbox">
            <img class="img-responsive" src="{{asset('image/registerback.jpg')}}" />
        </div>
        <div class="box" style="left:68%;top:5%;">
            <div>
                <img id="loginlogo" src="{{asset('image/logo-salesvision (2).png')}}" />
            </div>
            <div class="pagetitle">Register</div>
            <form name="signupForm" ng-submit ="postRegisterform(signupForm)" novalidate>
                {{ csrf_field() }}
                <div class="formcontent">
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.first_name.$error.required && signupForm.first_name.$touched }" ng-model="user.first_name"
                            name="first_name" class="form-control registertext" placeholder="First Name" required only-letters-input>
                        <div ng-messages="signupForm.first_name.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.first_name.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.last_name.$error.required && signupForm.last_name.$touched }" ng-model="user.last_name"
                            name="last_name" class="form-control registertext" placeholder="Last Name" required only-letters-input>
                        <div ng-messages="signupForm.last_name.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.last_name.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" ng-class="{submitting: signupForm.email.$error.email || signupForm.email.$error.required && signupForm.email.$touched}"
                            ng-model="user.email" name="email" class="form-control registertext" placeholder="Email" required>

                        <div ng-messages="signupForm.email.$error" class="error">
                            <div ng-message="email" ng-if="signupForm.email.$touched">Wrong email format.</div>
                            <div ng-message="required" ng-if="signupForm.email.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    
                    <div class="form-group" id="registerpassword">
                        <input id="regpass" type="password" ng-class="{submitting: signupForm.password.$error.minlength || signupForm.password.$error.pattern || signupForm.password.$error.required && signupForm.password.$touched}"
                            name="password" ng-model="user.password" ng-minlength="8" ng-pattern="/(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z])/"
                            class="form-control registertext" placeholder="Password" aria-required="true" required popover="Passwords must be at least 8 characters and contain one lower &amp; one uppercase letter, and one non-alpha character (a company_phone or a symbol.)"
                            popover-placement="bottom" popover-trigger="mouseenter" />
                        <div ng-messages="signupForm.password.$error" class="error">
                            <div ng-message="minlength && pattern" ng-if="signupForm.password.$touched">Wrong password format.</div>
                            <div ng-message="required" ng-if="signupForm.password.$touched">Can't leave this empty.</div>
                        </div>
                    </div>


                    <div class="form-group">
                        <input id="regconfpass" type="password" ng-class="{submitting: ((signupForm.password_confirmation.$error.required || signupForm.password_confirmation.$error.compareTo && user.password)  && signupForm.password_confirmation.$touched )}"
                            name="password_confirmation" ng-model="user.password_confirmation" class="form-control registertext" placeholder="Confirm Password"
                            compare-to="user.password" required>
                        <div ng-messages="signupForm.password_confirmation.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.password_confirmation.$touched">Can't leave this empty.</div>
                            <div ng-message="compareTo" ng-if="signupForm.password_confirmation.$touched">Passwords do not match! </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.company_name.$error.required && signupForm.company_name.$touched }" ng-model="user.company_name"
                            name="company_name" class="form-control registertext" placeholder="Company Name" required>
                         <div ng-messages="signupForm.company_name.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.company_name.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.company_id.$error.required && signupForm.company_id.$touched && error}" ng-model="user.company_id"
                            name="company_id"   class="form-control registertext" placeholder="Company ID" required>
                        <div class="error">
                            <div ng-show="signupForm.company_id.$error.required" ng-if="signupForm.company_id.$touched">Can't leave this empty.</div>
                            <div ng-show="error">@{{errorMessage_CID}}</div>   
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.company_phone.$error.required && signupForm.company_phone.$touched }" ng-model="user.company_phone"
                            name="company_phone" class="form-control registertext" ng-maxlength="10" placeholder="Phone" required
                            restrict-to="[0-9]">
                         <div ng-messages="signupForm.company_phone.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.company_phone.$touched">Can't leave this empty.</div>
                             <div ng-message="maxlength" ng-if="signupForm.company_phone.$touched">Maximum length is 10 numbers.</div>
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <button type="submit" ng-model="register" class="button register" >Register</button>
                </div>
            </form>
        </div>
    </div>

@endsection
