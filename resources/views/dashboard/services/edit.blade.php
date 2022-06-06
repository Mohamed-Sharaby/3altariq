@extends('dashboard.layouts.layout')
@section('title',' تعديل خدمة '.' '.$service->name)

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="breadcrumb">
                    <a href="{{route('admin.main')}}" class="header-title m-t-0 m-b-30"><i class="icon-home2 mr-2"></i>
                        الرئيسية</a> /
                    <a href="{{route('admin.services.index',['category'=>$service->category_id])}}" class="header-title m-t-0 m-b-30"><i
                            class="icon-home2 mr-2"></i>
                        خدمات القسم <span class="badge badge-success">{{$service->category->name}}</span> </a> /
                    <span class="breadcrumb-item active">@yield('title')</span>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title m-t-0 m-b-30"> تعديل خدمة
                                <span class="badge badge-success">{{$service->name}}</span>
                            </h4>

                            {!! Form::model($service,['route'=>['admin.services.update',$service->id],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                            @include('dashboard.services.form')
                            {!! Form::close() !!}
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection
