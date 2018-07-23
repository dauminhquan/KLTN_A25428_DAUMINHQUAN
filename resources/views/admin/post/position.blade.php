@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Quản lý sinh viên</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="index.html">Home</a></li>
                <li><a href="form_inputs_basic.html">Quản lý chức vụ</a></li>
                <li class="active">Danh sách chức vụ</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    <content-wrapper></content-wrapper>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/admin/post/position.js")}}"></script>
@endsection
@section('theme-asset')
    {{--<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
    <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
@endsection