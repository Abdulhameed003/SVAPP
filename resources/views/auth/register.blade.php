@extends('layouts.app')

@section('content')
    <div class="container" ng-app="salesVisionControllers" ng-controller="RegisterController">
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
                        <input type="text" ng-class="{submitting: signupForm.first_name.$error.required && signupForm.first_name.$touched }" ng-model="user.fname"
                            name="first_name" class="form-control registertext" placeholder="First Name" required only-letters-input>
                        <div ng-messages="signupForm.first_name.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.first_name.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.first_name.$error.required && signupForm.last_name.$touched }" ng-model="user.lname"
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
                            name="password_confirmation" ng-model="user.passconf" class="form-control registertext" placeholder="Confirm Password"
                            compare-to="user.password" required>
                        <div ng-messages="signupForm.password_confirmation.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.password_confirmation.$touched">Can't leave this empty.</div>
                            <div ng-message="compareTo" ng-if="signupForm.password_confirmation.$touched">Passwords do not match! </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.company_name.$error.required && signupForm.company_name.$touched }" ng-model="user.ComName"
                            name="company_name" class="form-control registertext" placeholder="Company Name" required>
                         <div ng-messages="signupForm.company_name.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.company_name.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.company_id.$error.required && signupForm.company_id.$touched }" ng-model="user.ComID"
                            name="company_id"   class="form-control registertext" placeholder="Company Id" required>
                        <div class="error">
                            <div ng-show="signupForm.company_id.$error.required" ng-if="signupForm.company_id.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.company_phone.$error.required && signupForm.company_phone.$touched }" ng-model="user.phone"
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
<!--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('f_name') ? ' has-error' : '' }}">
                            <label for="f_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="f_name" type="text" class="form-control" name="first_name" value="{{ old('f_name') }}" required autofocus>

                                @if ($errors->has('f_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('l_name') ? ' has-error' : '' }}">
                            <label for="l_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="l_name" type="text" class="form-control" name="last_name" value="{{ old('l_name') }}" required autofocus>

                                @if ($errors->has('l_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('l_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('Company_id') ? ' has-error' : '' }}">
                            <label for="company_id" class="col-md-4 control-label">Company ID</label>

                            <div class="col-md-6">
                                <input id="company_id" type="text" class="form-control" name="company_id" value="{{ old('company_id') }}" required autofocus>

                                @if ($errors->has('company_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('Company_name') ? ' has-error' : '' }}">
                            <label for="company_name" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('Company_phone') ? ' has-error' : '' }}">
                            <label for="company_phone" class="col-md-4 control-label">Company Phone</label>

                            <div class="col-md-6">
                                <input id="company_phone" type="text" class="form-control" name="company_phone" value="{{ old('company_phone') }}" required autofocus>

                                @if ($errors->has('company_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('user_role') ? ' has-error' : '' }}">
                            <label for="user_role" class="col-md-4 control-label">User Role</label>

                            <div class="col-md-6">
                                <input id="user_role" type="text" class="form-control" name="user_role" value="{{ old('user_role') }}" required autofocus>

                                @if ($errors->has('user_role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
