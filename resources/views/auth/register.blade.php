@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="loginleftbox">
            <img class="img-responsive" src="{{asset('image/registerback.jpg')}}" />
        </div>
        <div class="box" style="left:68%;top:5%;">
            <div>
                <img id="loginlogo" src="image/logo-salesvision (2).png" />
            </div>
            <div class="pagetitle">Register</div>
            <form name="signupForm" novalidate>
                <div class="formcontent">
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.userfname.$error.required && signupForm.userfname.$touched }" ng-model="user.fname"
                            name="userfname" class="form-control registertext" placeholder="Name" required>
                        <div class="error">
                            <div ng-show="signupForm.userfname.$error.required" ng-if="signupForm.userfname.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" ng-class="{submitting: signupForm.useremail.$error.email || signupForm.useremail.$error.required && signupForm.useremail.$touched}"
                            ng-model="user.email" name="useremail" class="form-control registertext" placeholder="Email" required>

                        <div ng-messages="signupForm.useremail.$error" class="error">
                            <div ng-message="email" ng-if="signupForm.useremail.$touched">Wrong email format.</div>
                            <div ng-message="required" ng-if="signupForm.useremail.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.userphone.$error.required && signupForm.userphone.$touched }" ng-model="user.phone"
                            name="userphone" class="form-control registertext" ng-pattern="/^[0-9]*$/" placeholder="Phone" required
                            numbers-only disallow-spaces>
                        <div class="error">
                            <div ng-show="signupForm.userphone.$error.required" ng-if="signupForm.userphone.$touched">Can't leave this empty.</div>
                        </div>
                    </div>

                    <div class="form-group" id="registerpassword">
                        <input id="regpass" type="password" ng-class="{submitting: signupForm.userpassword.$error.minlength || signupForm.userpassword.$error.pattern || signupForm.userpassword.$error.required && signupForm.userpassword.$touched}"
                            name="userpassword" ng-model="user.password" ng-minlength="8" ng-pattern="/(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z])/"
                            class="form-control registertext" placeholder="Password" aria-required="true" required popover="Passwords must be at least 8 characters and contain one lower &amp; one uppercase letter, and one non-alpha character (a number or a symbol.)"
                            popover-placement="bottom" popover-trigger="mouseenter" />
                        <div ng-messages="signupForm.userpassword.$error" class="error">
                            <div ng-message="minlength && pattern" ng-if="signupForm.userpassword.$touched">Wrong password format.</div>
                            <div ng-message="required" ng-if="signupForm.userpassword.$touched">Can't leave this empty.</div>
                        </div>
                    </div>


                    <div class="form-group">
                        <input id="regconfpass" type="password" ng-class="{submitting: ((signupForm.userpasswordconf.$error.required || signupForm.userpasswordconf.$error.compareTo && user.password)  && signupForm.userpasswordconf.$touched )}"
                            name="userpasswordconf" ng-model="user.passconf" class="form-control registertext" placeholder="Confirm Password"
                            compare-to="user.password" required>
                        <div ng-messages="signupForm.userpasswordconf.$error" class="error">
                            <div ng-message="required" ng-if="signupForm.userpasswordconf.$touched">Can't leave this empty.</div>
                            <div ng-message="compareTo" ng-if="signupForm.userpasswordconf.$touched">Passwords do not match! </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.usercompany.$error.required && signupForm.usercompany.$touched }" ng-model="user.ComName"
                            name="usercompany" class="form-control registertext" placeholder="Company Name" required>
                        <div class="error">
                            <div ng-show="signupForm.usercompany.$error.required" ng-if="signupForm.usercompany.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" ng-class="{submitting: signupForm.userComID.$error.required && signupForm.userComID.$touched }" ng-model="user.ComID"
                            name="userComID" class="form-control registertext" placeholder="Company Id" required>
                        <div class="error">
                            <div ng-show="signupForm.userComID.$error.required" ng-if="signupForm.userComID.$touched">Can't leave this empty.</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" ng-model="register" class="button register" ng-click="postRegisterform(signupForm)">Register</button>
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
