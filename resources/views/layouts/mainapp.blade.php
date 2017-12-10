@extends('layouts.app')
@section('content')
    <div ng-controller="mainCtrl">   
        @include('inc/navbar')
        @yield('content')
    </div>
@endsection