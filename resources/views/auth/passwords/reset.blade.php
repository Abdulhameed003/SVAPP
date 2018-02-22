@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="changepassctrl" >
        <div class="box" style="left: 35%; top: 15%;">

            <div>
                <img id="loginlogo" src="image/logo-salesvision (2).png" />
            </div>
            <form name="changepassform"  novalidate>
                    
                <div class="formcontent">
                        <input  type="hidden" name="token"  ng-model="user.token" ng-init="user.token='{{$token}}'" ng-required="true">
                        <div class="form-group">
                            <input  type="email" ng-class="{submitting: changepassform.email.$error.email || changepassform.email.$error.required && changepassform.email.$touched}"
                                ng-model="user.email" name="email" class="form-control registertext" placeholder="Email" required>
    
                            <div ng-messages="changepassform.email.$error" class="error">
                                <div ng-message="email" ng-if="changepassform.email.$touched">Wrong email format.</div>
                                <div ng-message="required" ng-if="sigchangepasform.email.$touched">Can't leave this empty.</div>
                            </div>
                        </div>
                        
                        <div class="form-group" id="registerpassword">
                            <input id="regpass" type="password" ng-class="{submitting: changepassform.password.$error.minlength || changepassform.password.$error.pattern || changepassform.password.$error.required && changepassform.password.$touched}"
                                name="password" ng-model="user.password" ng-minlength="8" ng-pattern="/(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z])/"
                                class="form-control registertext" placeholder="Password" aria-required="true" required popover="Passwords must be at least 8 characters and contain one lower &amp; one uppercase letter, and one non-alpha character (a number or a symbol.)"
                                popover-placement="bottom" popover-trigger="mouseenter" />
                            <div ng-messages="changepassform.password.$error" class="error">
                                <div ng-message="minlength && pattern" ng-if="changepassform.password.$touched">Wrong password format.</div>
                                <div ng-message="required" ng-if="changepassform.password.$touched">Can't leave this empty.</div>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <input  type="password" ng-class="{submitting: ((changepassform.password_confirmation.$error.required || changepassform.password_confirmation.$error.compareTo && user.password)  && changepassform.password_confirmation.$touched )}"
                                name="password_confirmation" ng-model="user.password_confirmation" class="form-control registertext" placeholder="Confirm Password"
                                compare-to="user.password" required>
                            <div ng-messages="changepassform.password_confirmation.$error" class="error">
                                <div ng-message="required" ng-if="changepassform.password_confirmation.$touched">Can't leave this empty.</div>
                                <div ng-message="compareTo" ng-if="changepassform.password_confirmation.$touched && user.password">Passwords do not match! </div>
    
                            </div>
                            
                        </div>
                        
                        
                </div>
                <div class="form-group">
                        <button type="submit" ng-model="login" class="button register" ng-click="postchpassform(changepassform)">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
