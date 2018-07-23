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
    <div id="app">
        <datatable title="Hello" columns="a b c d"></datatable>
    </div>
@endsection
@section("js-page")
    <script src="{{asset('assets/js/test/datatable/datatable.js')}}"></script>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
@endsection
