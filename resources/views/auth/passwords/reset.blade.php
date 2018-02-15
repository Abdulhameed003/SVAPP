@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="changepassctrl" >
        <div class="box" style="left: 35%; top: 15%;">

            <div>
                <img id="loginlogo" src="image/logo-salesvision (2).png" />
            </div>
            <form name="changepassform" novalidate>
                <div class="formcontent">
                        <input type="hidden" name="token" user.token="{{ $token }}">
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
                                name="password_confirmation" ng-model="user.password-confirmation" class="form-control registertext" placeholder="Confirm Password"
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
<!--div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

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

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div-->
@endsection
