<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 8/16/2018
 * Time: 10:21 AM
 */
?>
@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Quản lý việc làm của sinh viên</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="active">Quy đổi dữ liệu</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    <form enctype="multipart/form-data" method="post">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="panel-title">Quy đổi dữ liệu</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    @foreach($tables as $table)
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tải dữ liệu bảng <a href="{{route('admin.export.data',['table' => $table['name']])}}" target="_blank"><b>{{$table['name']}}</b></a></label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-right">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary">Chuyển đổi <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section("js-page")
@endsection
@section('theme-asset')

@endsection
