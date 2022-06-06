@extends('dashboard.layouts.layout')
@section('title',' احصائيات الخدمات')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.services.index',['category'=>$category->id])}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        خدمات القسم <span class="badge badge-success">{{$category->name}}</span> </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div class="col-lg-12 ">
                                <div class="card-box bg-white">
                                    <h4 class="header-title m-t-0 m-b-30 text-black-50">احصائات الخدمات</h4>
                                    <div id="service_cities"> </div>
                                </div>
                            </div><!-- end col -->
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('morris.js/dist/morris.css')}}">
@endpush
@push('my-js')
    <script src="{{asset('admin/assets/plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('morris.js/dist/morris.js')}}"></script>
    <script>
        Morris.Donut({
            element: 'service_cities',
            data: @json($service_cities)
        });


    </script>
@endpush
