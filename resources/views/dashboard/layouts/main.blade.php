@extends('dashboard.layouts.layout')
@section('title','عالطريق - لوحة التحكم')

@section('content')
    <div class="row" style="margin-top: 10px!important;">

        @can('Roles')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.roles.index')}}">
                    <div class="card-box bg-info">
                        <h4 class="header-title m-t-0 m-b-30 text-white">الصلاحيات والمناصب</h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-balance-scale fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\Spatie\Permission\Models\Role::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Admins')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.admins.index')}}">
                    <div class="card-box bg-success">
                        <h4 class="header-title m-t-0 m-b-30 text-white">الادارة </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-life-ring fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Admin::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan


        @can('Users')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.users.index')}}">
                    <div class="card-box bg-danger">
                        <h4 class="header-title m-t-0 m-b-30 text-white">العملاء </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-users fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\User::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

{{--        @can('Services')--}}
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <a href="{{route('admin.services.index')}}">--}}
{{--                    <div class="card-box bg-warning">--}}
{{--                        <h4 class="header-title m-t-0 m-b-30 text-white">الخدمات </h4>--}}
{{--                        <div class="widget-chart-1">--}}
{{--                            <div class="widget-chart-box-1">--}}
{{--                                <i class="zmdi zmdi-apps zmdi-hc-4x text-white"></i>--}}
{{--                            </div>--}}
{{--                            <div class="widget-detail-1">--}}
{{--                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Service::count()}} </h2>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div><!-- end col -->--}}
{{--        @endcan--}}

            @can('Banners')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.banners.index')}}">
                    <div class="card-box bg-info">
                        <h4 class="header-title m-t-0 m-b-30 text-white">البانرات </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-collection-folder-image zmdi-hc-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Banner::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Categories')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.categories.index')}}">
                    <div class="card-box bg-primary">
                        <h4 class="header-title m-t-0 m-b-30 text-white">الاقسام </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-input-composite zmdi-hc-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Category::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Providers')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.providers.index')}}">
                    <div class="card-box bg-pink">
                        <h4 class="header-title m-t-0 m-b-30 text-white">مقدمى الخدمات </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="fa fa-recycle fa-4x text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Provider::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan


        @can('Carts')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.orders.index')}}">
                    <div class="card-box bg-purple">
                        <h4 class="header-title m-t-0 m-b-30 text-white">الطلبات </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-4x  text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Order::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan

        @can('Reports')
            <div class="col-lg-3 col-md-6">
                <a href="{{route('admin.reports.index')}}">
                    <div class="card-box bg-danger">
                        <h4 class="header-title m-t-0 m-b-30 text-white">البلاغات </h4>
                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1">
                                <i class="zmdi zmdi-block-alt zmdi-hc-4x  text-white"></i>
                            </div>
                            <div class="widget-detail-1">
                                <h2 class="p-t-10 m-b-0 text-white"> {{\App\Models\Report::count()}} </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
        @endcan
            <div class="col-lg-12 ">
                    <div class="card-box bg-white">
                        <h4 class="header-title m-t-0 m-b-30 text-black-50">مقدمين الخدمة في المحافظات</h4>
                        <div id="providers-in-cities"> </div>
                    </div>
            </div><!-- end col -->
            <div class="col-lg-12 ">
                    <div class="card-box bg-white">
                        <h4 class="header-title m-t-0 m-b-30 text-black-50">مقدمين الخدمات</h4>
                        <div id="daily_providers"> </div>
                    </div>
            </div><!-- end col -->
            <div class="col-lg-12 ">
                    <div class="card-box bg-white">
                        <h4 class="header-title m-t-0 m-b-30 text-black-50">العملاء</h4>
                        <div id="daily_users"> </div>
                    </div>
            </div><!-- end col -->
    </div>
    <!-- end row -->


@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('morris.js/dist/morris.css')}}">
@endpush
@push('my-js')
    <script src="{{asset('admin/assets/plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('morris.js/dist/morris.js')}}"></script>
    <script>
        Morris.Donut({
            element: 'providers-in-cities',
            data: @json($providers_in_country)
        });
        Morris.Line({
            element: 'daily_providers',
            data:@json($daily_providers),
            xkey: 'date_created_at',
            ykeys: ['providers'],
            labels: ['العدد'],
            parseTime: false,
            resize: true

        });
        Morris.Line({
            element: 'daily_users',
            data:@json($daily_users),
            xkey: 'date_created_at',
            ykeys: ['users'],
            labels: ['العدد'],
            parseTime: false,
            resize: true

        });

    </script>
@endpush
