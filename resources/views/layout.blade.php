<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/icons/icomoon/styles.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/bootstrap.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/core.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/components.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("assets/css/colors.css")}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->



</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-people"></i>
                    <span class="visible-xs-inline-block position-right">Người dùng online</span>
                </a>

                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-heading">
                        Người dùng online
                        <ul class="icons-list">
                            <li><a href="#"><i class="icon-gear"></i></a></li>
                        </ul>
                    </div>

                    <ul class="media-list dropdown-content-body width-300">
                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Jordana Ansley</a>
                                <span class="display-block text-muted text-size-small">Lead web developer</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-success"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Will Brason</a>
                                <span class="display-block text-muted text-size-small">Marketing manager</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-danger"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Hanna Walden</a>
                                <span class="display-block text-muted text-size-small">Project manager</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-success"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Dori Laperriere</a>
                                <span class="display-block text-muted text-size-small">Business developer</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-warning-300"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Vanessa Aurelius</a>
                                <span class="display-block text-muted text-size-small">UX expert</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-grey-400"></span></div>
                        </li>
                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="All users"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>
        </ul>

        <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown language-switch">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/flags/vn.png" class="position-left" alt="">
                    Tiếng việt
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="deutsch"><img src="assets/images/flags/de.png" alt=""> Deutsch</a></li>
                    <li><a class="ukrainian"><img src="assets/images/flags/ua.png" alt=""> Українська</a></li>
                    <li><a class="english"><img src="assets/images/flags/gb.png" alt=""> English</a></li>
                    <li><a class="espana"><img src="assets/images/flags/es.png" alt=""> España</a></li>
                    <li><a class="russian"><img src="assets/images/flags/ru.png" alt=""> Русский</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="visible-xs-inline-block position-right">Messages</span>
                    <span class="badge bg-warning-400">2</span>
                </a>

                <div class="dropdown-menu dropdown-content width-350">
                    <div class="dropdown-content-heading">
                        Messages
                        <ul class="icons-list">
                            <li><a href="#"><i class="icon-compose"></i></a></li>
                        </ul>
                    </div>

                    <ul class="media-list dropdown-content-body">
                        <li class="media">
                            <div class="media-left">
                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                <span class="badge bg-danger-400 media-badge">5</span>
                            </div>

                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">James Alexander</span>
                                    <span class="media-annotation pull-right">04:58</span>
                                </a>

                                <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                                <span class="badge bg-danger-400 media-badge">4</span>
                            </div>

                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Margo Baker</span>
                                    <span class="media-annotation pull-right">12:16</span>
                                </a>

                                <span class="text-muted">That was something he was unable to do because...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Jeremy Victorino</span>
                                    <span class="media-annotation pull-right">22:48</span>
                                </a>

                                <span class="text-muted">But that would be extremely strained and suspicious...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Beatrix Diaz</span>
                                    <span class="media-annotation pull-right">Tue</span>
                                </a>

                                <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Richard Vango</span>
                                    <span class="media-annotation pull-right">Mon</span>
                                </a>

                                <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                            </div>
                        </li>
                    </ul>

                    <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
                    </div>
                </div>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/placeholder.jpg" alt="">
                    <span>Victoria</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> Thông tin cá nhân</a></li>
                    <li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Hỗ trợ</a></li>
                    <li class="divider"></li>

                    <li><a href="#"><i class="icon-switch2"></i> Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>
{{--Sinh viên--}}
{{--<div class="navbar-collapse collapse" id="navbar-second-toggle">--}}
{{--<ul class="nav navbar-nav">--}}
{{--<li><a href="index.html"><i class="icon-display4 position-left"></i> Trang chủ</a></li>--}}
{{--<li><a href="index.html"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>--}}
{{--<li><a href="index.html"><i class="icon-display4 position-left"></i> Bảng tin doanh nghiệp đào tạo</a></li>--}}
{{--<li><a href="index.html"><i class="icon-bell2 position-left"></i> Thông báo nhà trường</a></li>--}}
{{--<li class="dropdown">--}}
{{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--<i class="icon-make-group position-left"></i> Quản lý thư <span class="caret"></span>--}}
{{--</a>--}}

{{--<ul class="dropdown-menu width-250">--}}
{{--<li class="dropdown-header">Quản lý thư</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-task"></i> Gửi thư</a>--}}
{{--</li>--}}

{{--<li>--}}
{{--<a href="#"><i class="icon-images2"></i>Hộp thư đến</a>--}}
{{--</li>--}}

{{--<li>--}}
{{--<a href="#"><i class="icon-grid6"></i> Thùng rác</a>--}}
{{--</li>--}}

{{--</ul>--}}
{{--</li>--}}
{{--<li class="dropdown">--}}
{{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--<i class="icon-make-group position-left"></i> Quản lý khóa học <span class="caret"></span>--}}
{{--</a>--}}

{{--<ul class="dropdown-menu width-250">--}}


{{--<li>--}}
{{--<a href="#"><i class="icon-grid6"></i> Quản lý khóa học của bạn</a>--}}
{{--</li>--}}

{{--<li class="dropdown-header">Danh sách khóa học của bạn</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-task"></i> Khóa học 1</a>--}}
{{--</li>--}}

{{--<li>--}}
{{--<a href="#"><i class="icon-images2"></i>Khóa học 2</a>--}}
{{--</li>--}}

{{--</ul>--}}
{{--</li>--}}
{{--<li class="dropdown">--}}
{{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--<i class="icon-make-group position-left"></i> Tuyển dụng <span class="caret"></span>--}}
{{--</a>--}}

{{--<ul class="dropdown-menu width-250">--}}
{{--<li class="dropdown-header">Quản lý tuyển dụng</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-task"></i> Đăng tin</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-task"></i> Gửi thư</a>--}}
{{--</li>--}}

{{--<li>--}}
{{--<a href="#"><i class="icon-images2"></i>Hộp thư đến</a>--}}
{{--</li>--}}

{{--<li>--}}
{{--<a href="#"><i class="icon-grid6"></i> Thùng rác</a>--}}
{{--</li>--}}

{{--</ul>--}}
{{--</li>--}}
{{--<li class="dropdown mega-menu mega-menu-wide">--}}
{{--<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-stars position-left"></i> Quản lý thông tin <span class="caret"></span></a>--}}

{{--<div class="dropdown-menu dropdown-content">--}}
{{--<div class="dropdown-content-body">--}}
{{--<div class="row">--}}
{{--<div class="col-md-3">--}}
{{--<span class="menu-heading underlined">Quản lý Sinh viên</span>--}}
{{--<ul class="menu-list">--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-stack2"></i> Danh sách sinh viên</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-align-center-horizontal"></i> Thêm mới sinh viên</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--<div class="col-md-3">--}}
{{--<span class="menu-heading underlined">Quản lý Doanh nghiệp</span>--}}
{{--<ul class="menu-list">--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-indent-decrease2"></i> Danh sách doanh nghiệp</a>--}}

{{--</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-sort"></i> Thêm mới doanh nghiệp</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--<div class="col-md-3">--}}
{{--<span class="menu-heading underlined">Bài đăng</span>--}}
{{--<ul class="menu-list">--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-graph"></i> Danh sách bài đăng</a>--}}

{{--</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-statistics"></i> Các bài đăng đang đợi duyệt</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--<div class="col-md-3">--}}
{{--<span class="menu-heading underlined">Thông báo đến doanh nghiệp</span>--}}
{{--<ul class="menu-list">--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-graph"></i> Danh sách thông báo</a>--}}

{{--</li>--}}
{{--<li>--}}
{{--<a href="#"><i class="icon-statistics"></i> Tạo thông báo đến doanh nghiệp</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</li>--}}
{{--<li class="dropdown mega-menu mega-menu-wide">--}}
{{--<a href="#"><i class="icon-stars position-left"></i> Sinh viên trúng tuyển <span class="caret"></span></a>--}}


{{--</li>--}}

{{--<li class="dropdown">--}}
{{--<a href="dsadsa.html">--}}
{{--<i class="icon-strategy position-left"></i> Hỗ trợ--}}
{{--hiển thị ra form nhập thư. Type là hỗ trợ--}}
{{--</a>--}}

{{--</li>--}}
{{--<li class="dropdown">--}}
{{--<a href="dsadsa.html">--}}
{{--<i class="icon-strategy position-left"></i> Thống kê--}}
{{--</a>--}}

{{--</li>--}}
{{--<li class="dropdown">--}}
{{--<a href="dsadsa.html">--}}
{{--<i class="icon-strategy position-left"></i> Thông tin cá nhân--}}
{{--</a>--}}

{{--</li>--}}
{{--</ul>--}}

{{--<ul class="nav navbar-nav navbar-right">--}}
{{--<li>--}}
{{--<a href="changelog.html">--}}
{{--<i class="icon-history position-left"></i>--}}
{{--Changelog--}}
{{--<span class="label label-inline position-right bg-success-400">1.5</span>--}}
{{--</a>--}}
{{--</li>--}}

{{--<li class="dropdown">--}}
{{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--<i class="icon-cog3"></i>--}}
{{--<span class="visible-xs-inline-block position-right">Share</span>--}}
{{--<span class="caret"></span>--}}
{{--</a>--}}

{{--<ul class="dropdown-menu dropdown-menu-right">--}}

{{--<li><a href="#"><i class="icon-statistics"></i> Thống kê</a></li>--}}

{{--<li class="divider"></li>--}}
{{--<li><a href="#"><i class="icon-gear"></i> All settings</a></li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
<!-- //sinh vien-->

    <!-- doanh nghiệp -->
<!--
    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li><a href="index.html"><i class="icon-display4 position-left"></i> Trang chủ</a></li>
            <li><a href="index.html"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>
            <li><a href="index.html"><i class="icon-display4 position-left"></i> Bảng tin doanh nghiệp đào tạo</a></li>
            <li><a href="index.html"><i class="icon-bell2 position-left"></i> Thông báo nhà trường</a></li>

            <li class="dropdown mega-menu mega-menu-wide">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-stars position-left"></i> Danh mục <span class="caret"></span></a>

                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-body">
                        <div class="row">
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Quản lý thư</span>
                                <ul class="menu-list">
                                    <li>
                                        <a href="#"><i class="icon-stack2"></i> Gửi thư</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-align-center-horizontal"></i> Thư đến</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-align-center-horizontal"></i> Thư đã gửi</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-align-center-horizontal"></i> Thùng rác</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Quản lý Khóa học</span>
                                <ul class="menu-list">
                                    <li>
                                        <a href="#"><i class="icon-sort"></i> Quản lý đăng tin khóa học</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-sort"></i> Quản lý các khóa học của bạn</a>
                                    </li>
                                    <li class="dropdown-header"> Danh sách khóa học của bạn</li>

                                    <li>
                                        <a href="#"><i class="icon-indent-decrease2"></i> Khóa học 1</a>
                                        <ul>
                                            <li><a href="sidebar_mini_collapse.html">Quản lý sinh viên</a></li>

                                            <li>
                                                <a href="#">Quản lý bài giảng</a>
                                                <ul>
                                                    <li><a href="sidebar_dual.html">Thêm bài giảng</a></li>
                                                    <li><a href="sidebar_dual_double_collapse.html">Danh sách bài giảng</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Bài đăng</span>
                                <ul class="menu-list">
                                    <li>
                                        <a href="#"><i class="icon-graph"></i> Thêm mới bài đăng</a>

                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-statistics"></i> Danh sách bài đăng của bạn</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Quản lý nhân viên</span>
                                <ul class="menu-list">
                                    <li>
                                        <a href="#"><i class="icon-graph"></i> Danh sách nhân viên</a>

                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="dsadsa.html">
                    <i class="icon-strategy position-left"></i> Hỗ trợ
                    {{--hiển thị ra form nhập thư. Type là hỗ trợ--}}
        </a>

    </li>
{{--<li class="dropdown">--}}
{{--<a href="dsadsa.html">--}}
{{--<i class="icon-strategy position-left"></i> Thống kê--}}
{{--</a>--}}

{{--</li>--}}
        <li class="dropdown">
            <a href="dsadsa.html">
                <i class="icon-strategy position-left"></i> Thông tin cá nhân
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
-->
    <!-- //doanh nghiệp -->

    <!-- Quản trị viên -->


    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li><a href="index.html"><i class=" icon-home2 position-left"></i> Trang chủ</a></li>
            <li><a href="index.html"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>
            <li><a href="index.html"><i class="icon-display4 position-left"></i> Bảng tin doanh nghiệp đào tạo</a></li>
            <li><a href="index.html"><i class="icon-bell2 position-left"></i> Thông báo nhà trường</a></li>

            <li class="dropdown mega-menu mega-menu-wide">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-stars position-left"></i> Danh mục <span class="caret"></span></a>

                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-body">
                        <div class="row">
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Quản lý thư</span>
                                <ul class="menu-list">
                                    <li>
                                        <a href="#"><i class="icon-stack2"></i> Gửi thư</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-align-center-horizontal"></i> Thư đến</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-align-center-horizontal"></i> Thư đã gửi</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-align-center-horizontal"></i> Thùng rác</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Quản lý doanh nghiệp</span>
                                <ul class="menu-list">
                                    <li>
                                        <a href="#"><i class="icon-indent-decrease2"></i>  Quản lý thông tin doanh nghiệp</a>
                                        <ul>
                                            <li><a href="sidebar_mini_collapse.html">Thêm mới doanh nghiệp</a></li>
                                            <li><a href="sidebar_mini_collapse.html">Danh sách doanh nghiệp</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-indent-decrease2"></i>  Quản lý các bài viết của doanh nghiệp</a>
                                        <ul>
                                            <li><a href="sidebar_mini_collapse.html">Danh sách doanh nghiệp</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#"><i class="icon-indent-decrease2"></i> Quản lý các khóa học doanh nghiệp</a>
                                        <ul>
                                            <li><a href="sidebar_mini_collapse.html">Danh sách khóa học</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Quản lý sinh viên</span>
                                <ul class="menu-list">
                                    <li>
                                        <a href="#"><i class="icon-graph"></i> Danh sách sinh viên</a>

                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-3">
                                <span class="menu-heading underlined">Quản lý thông báo đến doanh nghiệp</span>
                                <ul class="menu-list">
                                    <li>
                                        <a href="#"><i class="icon-graph"></i> Thêm mới thông báo</a>

                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-statistics"></i> Danh sách thông báo</a>
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">
                    <i class=" icon-phone-wave position-left"></i> Hỗ trợ

                </a>

            </li>
            <li class="dropdown">
                <a href="#">
                    <i class=" icon-stats-growth position-left"></i> Thống kê
                </a>

            {{--</li>--}}
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

                    <li><a href="#"><i class="icon-statistics"></i> Thống kê</a></li>

                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- //Quản trị viên -->
</div>
<!-- /second navbar -->


<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Forms</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="index.html">Home</a></li>
                <li><a href="form_inputs_basic.html">Forms</a></li>
                <li class="active">Basic inputs</li>
            </ul>
        </div>

    </div>
</div>
<!-- /page header -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content" id="page-content">

        <!-- Main content -->
    @section("page-content")

    @show
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->


<!-- Footer -->
<div class="footer text-muted">
    &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
</div>
<!-- /footer -->
<!-- Core JS files -->
<script type="text/javascript" src="{{asset("assets/js/plugins/loaders/pace.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/core/libraries/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/core/libraries/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/loaders/blockui.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/ui/nicescroll.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/ui/drilldown.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/plugins/notifications/sweet_alert.min.js")}}"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
{{--<script type="text/javascript" src="{{asset("assets/js/plugins/forms/styling/uniform.min.js")}}"></script>--}}
@section('theme-asset')
@show
<script type="text/javascript" src="{{asset("assets/js/core/app.js")}}"></script>
@section('js-page')
@show
{{--<script type="text/javascript" src="{{asset("assets/js/pages/form_inputs.js")}}"></script>--}}
<!-- /theme JS files -->
</body>
</html>
