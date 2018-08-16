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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Quy đổi từ tên doanh nghiệp sang Id:</label>
                            <input type="file" name="enterprise-csv" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Quy đổi từ tên mức lương sang Id:</label>
                            <input type="file" name="salary-csv" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Quy đổi từ tên chức vụ trong công việc của sinh viên sang Id :</label>
                            <input type="file" name="rank-csv" class="form-control">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Quy đổi <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section("js-page")
@endsection
@section('theme-asset')

@endsection
