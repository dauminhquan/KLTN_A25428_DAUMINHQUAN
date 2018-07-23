@extends('layout')
@section('page-content')
    <main-sidebar></main-sidebar>
    <main-content></main-content>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/list-job-theme.js")}}"></script>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
@endsection