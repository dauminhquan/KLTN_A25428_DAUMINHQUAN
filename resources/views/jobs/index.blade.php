@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Tìm việc</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="{{route('web.home')}}}">Home</a></li>
                <li class="active">Việc làm</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    <!-- Page content -->
    <web-content></web-content>
    <!-- /page content -->
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/jobs/index.js")}}"></script>
@endsection
@section('theme-asset')
@endsection
@section("mobile-panel-left")
    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
@endsection