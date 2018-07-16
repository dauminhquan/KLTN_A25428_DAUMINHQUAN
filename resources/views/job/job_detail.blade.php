@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Tìm việc</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="{{route('home')}}}">Home</a></li>
                <li><a href="{{route('job.list.job')}}">Tìm việc</a></li>
                <li class="active">Việc làm</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    
    <detail-content id-job="{{$id}}"></detail-content>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/job/list-job/job-detail.js")}}"></script>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
@endsection