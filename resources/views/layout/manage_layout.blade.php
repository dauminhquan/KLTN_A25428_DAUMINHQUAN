<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UEC ThangLong University | Thang Long University</title>
    <link href="{{asset('assets/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/common.css")}}" rel="stylesheet" type="text/css">

</head>
<body>
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{route('web.home')}}"><img src="{{asset("assets/images/logo.png")}}" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">

            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            @section("mobile-panel-left") @show
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown language-switch">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset("assets/images/flags/vn.png")}}" class="position-left" alt="">
                    Tiếng việt
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="deutsch"><img src="{{asset("assets/images/flags/de.png")}}" alt=""> Deutsch</a></li>
                    <li><a class="ukrainian"><img src="{{asset("assets/images/flags/ua.png")}}" alt=""> Українська</a></li>
                    <li><a class="english"><img src="{{asset("assets/images/flags/gb.png")}}" alt=""> English</a></li>
                    <li><a class="espana"><img src="{{asset("assets/images/flags/es.png")}}" alt=""> España</a></li>
                    <li><a class="russian"><img src="{{asset("assets/images/flags/ru.png")}}" alt=""> Русский</a></li>
                </ul>
            </li>

            <?php
            $user = session('user');
            $typeUser = $user->type;
            ?>
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{$user->avatar}}" alt="">
                    <span><?php

                        if($typeUser == 1)
                        {
                            echo $user->admin->name;
                        }
                        if($typeUser == 2)
                        {
                            echo $user->enterprise->name;
                        }
                        if($typeUser == 3)
                        {
                            echo $user->student->full_name;
                        }

                        ?></span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?php
                        if($typeUser == 1)
                        {
//                                        echo route('admin.profile');
                        }
                        if($typeUser == 2)
                        {
                            echo route('enterprise.profile');
                        }
                        if($typeUser == 3)
                        {
                            echo route('student.profile');
                        }


                        ?>"><i class="icon-user-plus"></i> Thông tin cá nhân</a></li>
                    <li class="divider"></li>

                    <li><a href="javascript:void(0)" id="logout"><i class="icon-switch2"></i> Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>
    @if($typeUser == 3)
        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li><a href="{{route('web.home')}}"><i class=" icon-home2 position-left"></i> Trang chủ</a></li>
                <li><a href="{{route('web.tasks.index')}}"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>
                <li><a href="{{route('web.notifies.index')}}"><i class="icon-bell2 position-left"></i> Thông báo nhà trường</a></li>
                <li><a href="{{route('web.events.index')}}"><i class="icon-alarm position-left"></i> Các sự kiện sắp diễn ra</a></li>
                <li class="dropdown">
                    <a href="{{route('student.profile')}}">
                        <i class="icon-profile position-left"></i> Thông tin cá nhân
                    </a>

                </li>
            </ul>
        </div>
    @endif
    @if(Auth::guard('web')->user()->type == 2)
        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li><a href="{{route('web.home')}}"><i class=" icon-home2 position-left"></i> Trang chủ</a></li>
                <li><a href="{{route('web.tasks.index')}}"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>
                <li><a href="{{route('web.notifies.index')}}"><i class="icon-bell2 position-left"></i> Thông báo nhà trường</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-make-group position-left"></i> Danh mục <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu width-250">
                        <li><a href="{{route('enterprise.tasks.index')}}">Quản lý tin</a></li>
                        <li><a href="{{route('enterprise.tasks.create')}}">Đăng tin</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{route('enterprise.profile')}}">
                        <i class="icon-profile position-left"></i> Thông tin cá nhân
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="changelog.html">
                        <i class="icon-history position-left"></i>
                        Changelog
                        <span class="label label-inline position-right bg-success-400">1.5</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog3"></i>
                        <span class="visible-xs-inline-block position-right">Share</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">

                        <li><a href="#"><i class="icon-statistics"></i> Thống kê</a></li>

                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    @endif
    @if($typeUser == 1)
        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li><a href="{{route('web.home')}}"><i class=" icon-home2 position-left"></i> Trang chủ</a></li>
                <li><a href="{{route('web.tasks.index')}}"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>
                <li><a href="{{route('web.notifies.index')}}"><i class="icon-bell2 position-left"></i> Thông báo nhà trường</a></li>
                <li class="dropdown mega-menu mega-menu-wide">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-stars position-left"></i> Danh mục <span class="caret"></span></a>
                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="menu-heading underlined">Quản lý khác</span>
                                    <ul class="menu-list">
                                        <li>
                                            <a href="{{route('admin.events.index')}}"><i class="icon-book2"></i> Danh sách sự kiện</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.users.index')}}"><i class="icon-user"></i> Quản lý tài khoản</a>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.works.index')}}"><i class="icon-package"></i> Quản lý việc làm sinh viên</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <span class="menu-heading underlined">Quản lý doanh nghiệp</span>
                                    <ul class="menu-list">
                                        <li>
                                            <a href="#"><i class="icon-indent-decrease2"></i>  Quản lý thông tin doanh nghiệp</a>
                                            <ul>
                                                <li><a href="{{route('admin.enterprises.index')}}">Danh sách doanh nghiệp</a></li>
                                                <li><a href="{{route('admin.enterprises.create')}}">Thêm mới doanh nghiệp</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-indent-decrease2"></i>  Quản lý việc làm</a>
                                            <ul>
                                                <li><a href="{{route('admin.tasks.index')}}">Quản lý bài viết doanh nghiệp</a></li>
                                                <li><a href="{{route('admin.positions.index')}}">Quản lý vị trí tuyển dụng</a></li>
                                                <li><a href="{{route('admin.skills.index')}}">Quản lý kỹ năng</a></li>
                                                <li><a href="{{route('admin.salaries.index')}}">Quản lý mức lương</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <span class="menu-heading underlined">Quản lý sinh viên</span>
                                    <ul class="menu-list">
                                        <li>
                                            <a href="#"><i class="icon-indent-decrease2"></i>  Quản lý sinh viên</a>
                                            <ul>
                                                <li><a href="{{route('admin.students.index')}}">Danh sách sinh viên</a></li>
                                                <li><a href="{{route('admin.ratings.index')}}">Quản lý hạng tốt nghiệp</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-indent-decrease2"></i>  Quản lý chuyên mục khác</a>
                                            <ul>
                                                <li>
                                                    <a href="{{route('admin.students.index')}}"><i class="icon-graph"></i> Quản lý khóa</a>

                                                </li>
                                                <li>
                                                    <a href="{{route('admin.departments.index')}}"><i class="icon-graph"></i> Quản lý khoa</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('admin.branches.index')}}"><i class="icon-graph"></i> Quản lý chuyên ngành</a>
                                                </li>

                                                <li>
                                                    <a href="{{route('admin.provinces.index')}}"><i class="icon-graph"></i> Quản lý tên tỉnh thành</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <span class="menu-heading underlined">Quản lý thông báo</span>
                                    <ul class="menu-list">
                                        <li>
                                            <a href="{{route('admin.notifies.create')}}"><i class="icon-alarm-add"></i> Thêm mới thông báo</a>

                                        </li>
                                        <li>
                                            <a href="{{route('admin.notifies.index')}}"><i class="icon-alarm"></i> Danh sách thông báo</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="{{route('admin.statistical.index')}}">
                        <i class=" icon-stats-growth position-left"></i> Thống kê
                    </a>
                <li class="dropdown">
                    <a href="#">
                        <i class="icon-profile position-left"></i> Thông tin cá nhân
                    </a>

                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="changelog.html">
                        <i class="icon-history position-left"></i>
                        Changelog
                        <span class="label label-inline position-right bg-success-400">1.5</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog3"></i>
                        <span class="visible-xs-inline-block position-right">Share</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{route('admin.statistical.index')}}"><i class="icon-statistics"></i> Thống kê</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    @endif
</div>
<div class="page-header">
    @section('header-content')
    @show
</div>
<div class="page-container" id="page-container">
    @section("page-content")@show
</div>

<div class="footer text-muted">
    &copy; 2018. <a href="{{route('web.home')}}">UEC TLU</a> by <a href="http://thanglong.edu.vn" target="_blank">ThangLong University</a>
</div>
<script type="text/javascript" src="{{asset("assets/js/common.js")}}"></script>
@section('theme-asset')
@show
@section('js-page')
@show
</body>
</html>
