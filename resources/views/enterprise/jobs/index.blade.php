@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Quản lý việc làm</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="{{route('web.home')}}">Home</a></li>
                <li><a href="{{route('enterprise.jobs.index')}}">Quản lý việc làm</a></li>
                <li class="active">Danh sách việc làm</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    <div class="page-content" id="page-content">
        <table-content></table-content>
    </div>

@endsection

@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/enterprise/jobs/index.js")}}"></script>
@endsection
@section('theme-asset')
@endsection