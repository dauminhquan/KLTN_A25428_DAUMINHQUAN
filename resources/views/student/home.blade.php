@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <i class="icon-arrow-left52 position-left"></i>
                <span class="text-semibold">Home</span> - Dashboard
                <small class="display-block">Chúc {{session('user')->student()->select('last_name')->first()->name ?? 'bạn'}} một ngày làm việc vui vẻ  ^^</small>
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
                            <?php $userAccoutn = session('user')->student()->select('code','last_name')->first() ?>
                            <h3 class="no-margin">{{\App\Models\Event::count()}}</h3>
                            Sự kiện mới
                            <div class="text-muted text-size-small">{{\App\Models\Event::where('created_at','>=',DB::raw('date(now())'))->count()}} </div>
                        </div>
                        <div class="container-fluid">
                            <div id="members-online"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="panel bg-pink-400">
                        <div class="panel-body">
                            <h3 class="no-margin">{{\App\Models\Event::where('created_at','>=',DB::raw('date(now())'))->count()}}</h3>
                            Thông báo hôm nay
                            <div class="text-muted text-size-small">Có gì mới?</div>
                        </div>

                        <div id="server-load"></div>
                    </div>
                </div>
            </div>
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
                <?php $tasks = \App\Models\Task::orderByDesc('updated_at')->limit(10)->get() ?>
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
                                            <a href="{{route('web.events.info',['id' => $item->id])}}">{{$item->title}}</a>
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