@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Thêm một thông báo</span></h4>
            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li><a href="{{route('admin.notifies.index')}}">Quản lý thông báo</a></li>
                <li class="active">Thêm một thông báo</li>
            </ul>
        </div>
    </div>
@endsection
@section('page-content')
    <div class="page-content" id="page-content">
        <web-content></web-content>
    </div>

@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/admin/notifies/create.js")}}"></script>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset("assets/js/plugins/ckeditor/ckeditor.js")}}"></script>
@endsection