@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Quản lý mức lương</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li><a href="{{route('admin.salaries.index')}}">Quản lý mức lương</a></li>
                <li class="active">Danh sách mức lương</li>
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
    <script type="text/javascript" src="{{asset("assets/js/build/pages/admin/salaries/index.js")}}"></script>
@endsection
@section('theme-asset')
    {{--<script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>--}}
@endsection