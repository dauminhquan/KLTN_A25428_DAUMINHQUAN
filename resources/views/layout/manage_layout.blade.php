<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UEC ThangLong University | Thang Long University</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/common.css")}}" rel="stylesheet" type="text/css">
</head>

<body>


<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="{{asset("assets/images/logo_light.png")}}" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">

            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            @section("mobile-panel-left") @show
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li>
                <a class="sidebar-control sidebar-main-hide hidden-xs">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
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
                            <div class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Jordana Ansley</a>
                                <span class="display-block text-muted text-size-small">Lead web developer</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-success"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Will Brason</a>
                                <span class="display-block text-muted text-size-small">Marketing manager</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-danger"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Hanna Walden</a>
                                <span class="display-block text-muted text-size-small">Project manager</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-success"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Dori Laperriere</a>
                                <span class="display-block text-muted text-size-small">Business developer</span>
                            </div>
                            <div class="media-right media-middle"><span class="status-mark border-warning-300"></span></div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></div>
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
                                <img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt="">
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
                                <img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt="">
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
                            <div class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Jeremy Victorino</span>
                                    <span class="media-annotation pull-right">22:48</span>
                                </a>

                                <span class="text-muted">But that would be extremely strained and suspicious...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></div>
                            <div class="media-body">
                                <a href="#" class="media-heading">
                                    <span class="text-semibold">Beatrix Diaz</span>
                                    <span class="media-annotation pull-right">Tue</span>
                                </a>

                                <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left"><img src="{{asset("assets/images/placeholder.jpg")}}" class="img-circle img-sm" alt=""></div>
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
                    <img src="{{asset("assets/images/placeholder.jpg")}}" alt="">
                    <span>Victoria</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> Thông tin cá nhân</a></li>
                    <li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Hỗ trợ</a></li>
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

  {{--  @if(Auth::guard('web')->user()->type == 3)

        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li><a href="{{route('home')}}"><i class=" icon-home2 position-left"></i> Trang chủ</a></li>
                <li><a href="{{route('job.list.job')}}"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>
                <li><a href="#"><i class="icon-display4 position-left"></i> Bảng tin doanh nghiệp đào tạo</a></li>
                <li><a href="#"><i class="icon-bell2 position-left"></i> Thông báo nhà trường</a></li>

                <li class="dropdown">
                    <a href="{{route('student.profile')}}">
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
<!-- //sinh vien-->

    <!-- doanh nghiệp -->
    @if(Auth::guard('web')->user()->type == 2)

        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li><a href="{{route('home')}}"><i class=" icon-home2 position-left"></i> Trang chủ</a></li>
                <li><a href="{{route('job.list.job')}}"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>
                <li><a href="#"><i class="icon-display4 position-left"></i> Bảng tin doanh nghiệp đào tạo</a></li>
                <li><a href="#"><i class="icon-bell2 position-left"></i> Thông báo nhà trường</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-make-group position-left"></i> Danh mục <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu width-250">

                        <li class="dropdown-submenu">
                            <a href="#"><i class="icon-book2"></i> Khóa học</a>
                            <ul class="dropdown-menu width-200">
                                <li class="dropdown-header highlight">Options</li>
                                <li><a href="{{route('enterprise.post.course.manage.index')}}">Quản lý khóa học</a></li>
                                <li><a href="{{route('enterprise.post.course.manage.new.post.course')}}">Thêm mới khóa học</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#"><i class="icon-joomla"></i> Tuyển dụng</a>
                            <ul class="dropdown-menu width-200">
                                <li class="dropdown-header highlight">Options</li>
                                <li><a href="{{route('enterprise.post.manage.index')}}">Quản lý tin</a></li>
                                <li><a href="{{route('enterprise.post.manage.new.post')}}">Đăng tin</a></li>
                            </ul>
                        </li>
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
<!-- //doanh nghiệp -->

    <!-- Quản trị viên -->--}}

    {{--@if(Auth::guard('web')->user()->type == 1)--}}
        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                {{--<li><a href="{{route('home')}}"><i class=" icon-home2 position-left"></i> Trang chủ</a></li>
                <li><a href="{{route('job.list.job')}}"><i class=" icon-newspaper position-left"></i> Bảng tin tuyển dụng</a></li>
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
                                                <li><a href="{{route('admin.enterprise.manage.index')}}">Danh sách doanh nghiệp</a></li>
                                                <li><a href="{{route('admin.enterprise.manage.add.enterprise')}}">Thêm mới doanh nghiệp</a></li>

                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-indent-decrease2"></i>  Quản lý các bài viết công việc</a>
                                            <ul>
                                                <li><a href="{{route('admin.job.manage.jobs')}}">Danh sách bài viết doanh nghiệp</a></li>
                                                <li><a href="{{route('admin.job.manage.position')}}">Danh sách vị trí</a></li>
                                                <li><a href="{{route('admin.job.manage.skill')}}">Danh sách kỹ năng</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#"><i class="icon-indent-decrease2"></i> Quản lý các khóa học doanh nghiệp</a>
                                            <ul>
                                                <li><a href="{{route('admin.post.courses')}}">Danh sách khóa học</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <span class="menu-heading underlined">Quản lý sinh viên</span>
                                    <ul class="menu-list">
                                        <li>
                                            <a href="{{route('admin.student.manage.index')}}"><i class="icon-graph"></i> Danh sách sinh viên</a>

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
                        <i class=" icon-stats-growth position-left"></i> Thống kê
                    </a>


                <li class="dropdown">
                    <a href="#">
                        <i class="icon-profile position-left"></i> Thông tin cá nhân
                    </a>

                </li>--}}
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
{{--@endif--}}


<!-- //Quản trị viên -->
</div>
<!-- /second navbar -->


<!-- Page header -->
<div class="page-header">
    @section('header-content')
    @show
</div>
<!-- /page header -->


<!-- Page container -->
<div class="page-container" id="page-container">

    <!-- Page content -->
        <!-- Main content -->
    @section("page-content")
    @show
    <!-- /main content -->
    <!-- /page content -->

</div>
<!-- /page container -->


<!-- Footer -->
<div class="footer text-muted">
    &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
</div>
<!-- /footer -->
<!-- Core JS files -->
<script type="text/javascript" src="{{asset("assets/js/common.js")}}"></script>
@section('theme-asset')
@show

@section('js-page')
@show
</body>
</html>
