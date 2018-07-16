@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Quản lý tin tuyển dụng</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="#">Home</a></li>
                <li><a href="{{route('enterprise.post.manage.index')}}">Quản lý tin tuyển dụng</a></li>
                <li class="active">Danh sách tin</li>
            </ul>
        </div>
    </div>
@endsection
@section('page-content')
    <content-wrapper></content-wrapper>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/enterprise/post-course-manage/post-course-manage.js")}}"></script>
@endsection
@section('theme-asset')
    {{--<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
    <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
@endsection