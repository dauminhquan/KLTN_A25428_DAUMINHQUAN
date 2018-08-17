@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <i class="icon-arrow-left52 position-left"></i>
                <span class="text-semibold">Home</span> - Dashboard
                <small class="display-block">Chúc {{session('user')->enterprise()->select('name')->first()->name}} một ngày làm việc vui vẻ  ^^</small>
            </h4>
            <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
    </div>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-lg-12">

            <!-- Quick stats boxes -->
            <div class="row">
                <div class="col-lg-6">

                    <!-- Members online -->
                    <div class="panel bg-teal-400">
                        <div class="panel-body">
                            <div class="heading-elements">
                                <span class="heading-text badge bg-teal-800"></span>
                            </div>
                            <?php $userAccoutn = session('user')->enterprise()->select('id','name')->first() ?>
                            <h3 class="no-margin">{{\App\Models\Task::count()}}</h3>
                            Tin tuyển dụng
                            <div class="text-muted text-size-small">{{\App\Models\Task::where('accept',1)->where('created_at','>=',DB::raw('date(now())'))->where('enterprise_id',$userAccoutn->id)->count()}} đã được đăng</div>
                        </div>

                        <div class="container-fluid">
                            <div id="members-online"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="panel bg-pink-400">
                        <div class="panel-body">
                            <h3 class="no-margin">{{\App\Models\Notification::where('created_at','>=',DB::raw('date(now())'))->count()}}</h3>
                            Thông báo hôm nay
                            <div class="text-muted text-size-small">Có gì mới?</div>
                        </div>

                        <div id="server-load"></div>
                    </div>
                </div>
            </div>
            <!-- /quick stats boxes -->


            <!-- Support tickets -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Danh sách tin đang đợi <small><span class="badge bg-blue">{{\App\Models\Task::where('accept',0)->where('enterprise_id',$userAccoutn->id)->count()}}</span></small> </h6>
                    <div class="heading-elements text-right">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 50px">Thời gian gửi</th>
                            <th style="width: 300px;">Người gửi</th>
                            <th>Mô tả</th>
                            <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                        </tr>
                        </thead>
                        <?php $data = \App\Models\Task::where('accept',0)->where('enterprise_id',$userAccoutn->id)->orderByDesc('created_at')->limit(10)->get() ?>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td class="text-center">
                                    <h6 class="no-margin"><small class="display-block text-size-small no-margin">{{$item->created_at}}</small></h6>
                                </td>
                                <td>
                                    <div class="media-left media-middle">
                                        <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
                                            <span class="letter-icon"></span>
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <a href="{{route('enterprise.profile')}}" class="display-inline-block text-default text-semibold letter-icon-title">{{$userAccoutn->name}}</a>
                                        <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Tài khoản đã được xác thực</div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('enterprise.tasks.edit',['id' => $item->id])}}" class="text-default display-inline-block">
                                        <span class="text-semibold">[#{{$item->id}}] {{$item->title}}</span>
                                        <span class="display-block text-muted">{{$item->description}}</span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{route('enterprise.tasks.edit',['id' => $item->id])}}"><i class="icon-info3"></i>Thông tin chi tiết</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /support tickets -->


            <!-- Latest posts -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Tin mới được đăng gần đây</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <?php $tasks = \App\Models\Task::orderByDesc('updated_at')->where('enterprise_id',$userAccoutn->id)->limit(10)->get() ?>
                <div class="panel-body">
                    <div class="row">
                        @foreach($tasks as $item)
                            <div class="col-lg-6">
                                <ul class="media-list content-group">
                                    <li class="media stack-media-on-mobile">
                                        <div class="media-left">
                                            <div class="thumb">
                                                <a href="#">
                                                    <img src="{{asset('assets/images/placeholder.jpg')}}}" class="img-responsive img-rounded media-preview" alt="">
                                                    <span class="zoom-image"><i class="icon-play3"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><a href="#">{{$item->tile}}</a></h6>
                                            <ul class="list-inline list-inline-separate text-muted mb-5">
                                                <li>{{date_format($item->updated_at,'d/m/Y H:i:s')}}</li>
                                            </ul>
                                            <a href="{{route('web.tasks.info',['id' => $item->id])}}">{{$item->title}}</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Thông báo mới</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <?php $notifies = \App\Models\Notification::limit(10)->get() ?>
                <div class="panel-body">
                    <div class="row">
                        @foreach($notifies as $item)
                            <div class="col-lg-6">
                                <ul class="media-list content-group">
                                    <li class="media stack-media-on-mobile">
                                        <div class="media-left">
                                            <div class="thumb">
                                                <a href="#">
                                                    <img src="{{asset('assets/images/placeholder.jpg')}}}" class="img-responsive img-rounded media-preview" alt="">
                                                    <span class="zoom-image"><i class="icon-play3"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading"><a href="#">{{$item->tile}}</a></h6>
                                            <ul class="list-inline list-inline-separate text-muted mb-5">
                                                <li>{{date_format($item->updated_at,'d/m/Y H:i:s')}}</li>
                                            </ul>
                                            <a href="{{route('web.notifies.info',['id' => $item->id])}}">{{$item->title}}</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/home/index.js")}}"></script>
@endsection
@section('theme-asset')

@endsection
