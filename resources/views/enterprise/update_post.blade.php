@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Đăng tin tuyển dụng</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="#">Home</a></li>
                <li><a href="{{route('post.manage.post-manage')}}">Quản lý tin tuyển dụng</a></li>
                <li class="active">Sửa tin tuyển dụng</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    <content-wrapper id-post="{{$id}}"></content-wrapper>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/enterprise/post-manage/update-post.js")}}"></script>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
@endsection