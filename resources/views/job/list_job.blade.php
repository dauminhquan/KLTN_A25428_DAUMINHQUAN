@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Tìm việc</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="index.html">Home</a></li>

                <li class="active">Việc làm</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    <main-sidebar></main-sidebar>
    <main-content></main-content>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/job/list-job/list-job.js")}}"></script>
@endsection
@section("mobile-panel-left")
    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
@endsection
