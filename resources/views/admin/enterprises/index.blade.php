@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Quản lý sinh viên</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="index.html">Home</a></li>
                <li><a href="#">Quản lý doanh nghiệp</a></li>
                <li class="active">Danh sách doanh nghiệp</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')

    {{--<test-table></test-table>--}}
    <table-content></table-content>
@endsection

@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/admin/enterprises/index.js")}}"></script>
@endsection
@section('theme-asset')
    {{--<script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>--}}
@endsection