@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Thống kê</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="active">Thống kê</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    <!-- Page content -->
    <div class="page-content">
        <div class="content-wrapper">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        Thống kê tốt nghiệp theo khoa và theo khóa
                    </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li>
                                <div class="multi-select-full">

                                    <select name="" id="departments" class="multiselect" multiple="multiple">
                                        @foreach($courses as $course)
                                            <option value="{{$course['code']}}">{{$course['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="chart-container">
                        <div class="chart has-fixed-height" id="basic_columns"></div>
                    </div>
                </div>
            </div>


            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Thống kê Sự kiện</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="chart-container">
                        <div class="chart has-fixed-height" id="thermometer_columns"></div>
                    </div>
                </div>
            </div>




        </div>


    </div>


@endsection

@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/plugins/visualization/echarts/echarts.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/charts/echarts/columns_waterfalls.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/charts/echarts/timeline_option.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/build/pages/admin/statistics/index.js")}}"></script>
@endsection
@section('theme-asset')

@endsection
