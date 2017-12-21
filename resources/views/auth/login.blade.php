@extends('layouts.app')

@section('content')
<div class "container" ng-app="myApp" ng-controller="mainCtrl">   
    <div  id="loginleftbox" >
        <img   class="img-responsive" src="image/loginback1.jpg" />
    </div>

    <div class="box" style="left: 68%; top: 15%;">
        <div>
            <img  id="loginlogo" src="image/logo-salesvision (2).png" />
        </div>
        <div class="pagetitle">Login</div>

        <form method="POST" action="{{ route('log_in.submit') }}" novalidate>
            
            <div id="login_form" class="formcontent">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }}">
                    <div >
                        <input id="company_id"  type="text" class="form-control registertext" name="company_id"  value="{{ old('company_id') }}" placeholder="Company ID" required autofocus>

                        @if ($errors->has('company_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!--input type="text" ng-model="company_id" class="form-control registertext" placeholder="Company Id"-->
                </div>

                <div class="form-group{{$errors->has('email') ? ' has-error' : '' }}">
                    <div>
                        <input  type="email" class="form-control registertext" name="email" value="{{old('email') }}" placeholder="Email"  required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!--input type="email" name="email" ng-model="Username" class="form-control registertext" placeholder="Email" -->
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div>
                        <input id="password" type="password" class="form-control registertext" name="password" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!--input type="password" name="password" ng-model="password" class="form-control registertext" placeholder="Password"-->
                </div>

                <div class="form-group">
                    <div>
                        <div class="checkbox">
                            <label style="color:#455A64">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <button type="submit" ng-model="login" class="button register">Sign In</button>
                <div ng-controller="forgetPasswordController">
                    <button type="button" ng-click="open('sm')" class="btn btn-link" id="forget-pass">Forgot your Password?</button>

                    <a class="btn btn-link" id="sign-up" href="{{route('register')}}" target="_self">
                        Register
                    </a>
                </div>
            </div>


        </form>
    </div>
</div>
<!--div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('log_in.submit') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }}">
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

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div-->
@endsection
